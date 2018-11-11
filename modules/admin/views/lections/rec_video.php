<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
$this->title = 'Мультимедиа-лекторий | Запись лекции №'.$lectionModel['id'];

$this->registerMetaTag(['name' => 'keywords', 'content' => $model['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $model['description']]);


$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li>\n",'label' => 'Лекции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li>\n",'label' => 'Запись', 'url' => ['rec', 'id' => $lectionModel['id']]];


$arLection = [
    'video'=> ArrayHelper::toArray($video),
    'demonstrations'=> ArrayHelper::toArray($arDemos),
    'commands' => [],
];
$json = json_encode($arLection, JSON_UNESCAPED_UNICODE);

# Yii::$app->userHelperClass->pre($arLection);
# Yii::$app->userHelperClass->pre($arScenarios);


//ML_TODO: запись комманд


if ($video['file_src'])
{
    $video_src = $video['file_src'];

    if ((stristr($video['file_src'], 'youtu') === FALSE) && (stristr($video['file_src'], 'youtube') === FALSE))
    {
        $JSscript_str = '';
        $video_ext = pathinfo($video['file_src'])['extension'];

    }
    else
    {
        $video_ext = "mp4";
        $JSscript_str = app\components\VideoConverter::getYoutubeVideoData($video['file_src']);
    }
}

?>
<script>
    isREC = false;

    video = document.getElementById("video");

    $_GET = window.location.search.replace('?','').split('&').reduce(function(p,e) {
        var a = e.split('=');
        p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
        return p;
    }, {});

    $(document).ready(function(){
        $('#record_switch').on('change', function(){

            if ($('#record_switch').prop('checked'))
            {
                isREC = true;
                alert("Внимание! Включен режим записи лекции");
                video.play();
                demosList = [];
            }
            else
            {
                var isCancelled = confirm("Вы действительно хотите отменить запись?");
                cancelRecording(isCancelled);
            }
        });


        var json = <?=$json?>;

        //добавляем иконки из списка json
        for (var i = 0; i < json.demonstrations.length; i++)
        {
            $('<div class="demo-icon-item"></div>')
                .append('<img data-src="" ' +
                    'class="img-rounded icon_item" ' +
                    'id="'+json.demonstrations[i].id+'"' +
                    'alt="'+json.demonstrations[i].id+'" ' +
                    'data-type="'+json.demonstrations[i].type+'" ' +
                    'data-slider_id="'+json.demonstrations[i].id+'" '+
                    'src="'+json.demonstrations[i].src+'">')
                .appendTo('.icon_list');

        }

        //переключение слайда по клику
        $(document).delegate('.icon_item','click', function () {
            if (typeof curTime !== 'undefined' && typeof durTime !== 'undefined')
            {
                $('.icon_item').css('border', '1px solid #cccccc');
                $(this).css('border', '2px solid #ff0000');

                //ML_TODO: действия по клику на разные типы демонстрации
                if ($(this).attr('data-type') == 'slide')
                {
                    var canvas = document.getElementById("demo_play_canvas");
                    ctx = canvas.getContext('2d');
                    canvas.width = canvas.offsetWidth;
                    canvas.height = canvas.offsetHeight;
                    var pic = new Image();
                    pic.src = $(this).attr('src');
                    ctx.drawImage(pic, 0, 0, canvas.width, canvas.height);
                    addDemo($(this).attr('data-slider_id'), curTime);
                }
                else
                {
                    console.log("no slide type");
                }
            }

        });


        $("#video").on("timeupdate", function(event){
            onTrackedVideoFrame(this.currentTime, this.duration);
        });
        function onTrackedVideoFrame(currentTime, duration){
            $("#current").text(currentTime); //Change #current to currentTime
            $("#duration").text(duration);

            curTime = currentTime;
            durTime = duration;
            //переключение демонстрациий по клику
        }


        //Модальное окно Сохранения записи
        $("#save_btn").click(function(){
            video.pause();
            $('#save_lection_record_confirm_modal').modal('show');
        });


        $('#save_lection_record_confirm_modal [data-cofirm="NO"]').click(function(){
            video.play();
        });

        $('#save_lection_record_confirm_modal [data-cofirm="OK"]').click(function(){
            $.ajax({
                url: '/admin/lections/rec-video?id='+$_GET['id']+'&idscn='+$_GET['idscn'],
                type: "POST",
                dataType: "json",
                data: "jsonDemosList=" + JSON.stringify(demosList),
                success: function (data) {
                    if(data.result == "ok")
                    {
                        $('#save_lection_record_confirm_modal').modal('hide');
                        $('#save_lection_record_success_modal').modal('show');
                        cancelRecording(true);
                    }
                    else
                    {
                        alert('recording fail!!! please repeat');
                    }
                }
            });

        });


        //код для вставки с youtube.com
        videos = document.querySelectorAll('video');
        for (var i = 0, l = videos.length; i < l; i++) {
            var video = videos[i];
            var src = video.src || (function () {
                var sources = video.querySelectorAll('source');
                for (var j = 0, sl = sources.length; j < sl; j++) {
                    var source = sources[j];
                    var type = source.type;
                    var isMp4 = type.indexOf('mp4') != -1;
                    if (isMp4) return source.src;
                }
                return null;
            })();
            if (src) {
                var isYoutube = src && src.match(/(?:youtu|youtube)(?:\.com|\.be)\/([\w\W]+)/i);
                if (isYoutube) {
                    var id = isYoutube[1].match(/watch\?v=|[\w\W]+/gi);
                    id = (id.length > 1) ? id.splice(1) : id;
                    id = id.toString();
                    // var mp4url = 'http://www.convertinmp4.com/redirect.php?video=';
                    // video.src = mp4url + id + '&v=HRC4QzvlgyVC3cPGffGnpal3cm7dTUcJ&hd=1';
                    video.src = 'http://www.convertinmp4.com/<?=$JSscript_str?>';
                }
            }
        }
    });

    //удобое представление времени
    var timeFormat = (function (){
        function num(val){
            val = Math.floor(val);
            return val < 10 ? '0' + val : val;
        }

        return function (ms){
            var sec = ms
                , hours = sec / 3600  % 24
                , minutes = sec / 60 % 60
                , seconds = sec % 60
            ;

            return num(hours) + ":" + num(minutes) + ":" + num(seconds);
        };
    })();

    function addDemo(demoID, demoTime)
    {
        //D:\OpenServer\domains\video_lectory\res\resWithVideo\js\script.js
        //D:\OpenServer\domains\video_lectory\res\resWithVideo\index.php
        //D:\OpenServer\domains\video_lectory\res\resWithVideo\action.php

        //D:\OpenServer\domains\video_lectory\res\resWithoutVideo\js\ajax.js

        //D:\OpenServer\domains\video_lectory\lesson\js\script.js
        //D:\OpenServer\domains\video_lectory\scenario\js\script.js
        //D:\OpenServer\domains\video_lectory\demo_libs\2D\2D.js

        if (isREC==true)
        {
            demosList.push({demoID: demoID, demoTime: demoTime});
        }
    }

    function cancelRecording(status)
    {
        video = document.getElementById("video");
        if (status == true)
        {
            isREC = false;
            video.pause();
            video.currentTime = 0;

            $('.icon_item').css('border', '1px solid #cccccc');
            var canvas = document.getElementById("demo_play_canvas");
            ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            demosList = [];
            $('#record_switch').prop('checked', false);
        }
        else
        {
            $('#record_switch').prop('checked', true);
        }
    }
</script>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => 'Главная', 'url' => '/'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<!--Main layout-->
<div class="container-fluid">
    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <!--/.Page heading-->
    <hr>
    <ul class="nav nav-tabs tabs-light-green darken-1" role="tablist">
        <li class="nav-item">
            <a class="nav-link waves-light active" href="/admin/lections/index/">Лекции</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/lections/slides/">Слайды</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/scenarios/" role="tab">Сценарии</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/video/" role="tab">Видео</a>
        </li>
    </ul>
    <br><br>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="embed-responsive embed-responsive-16by9">
                <video id="video" controls="controls" poster="<?=$lectionModel['poster']?>" preload="none">
                    <source src="<?=$video['file_src']?>" type="video/<?=$video_ext?>"/>
                </video>
            </div>
        </div>
        <div class="col-md-6">
            <div class="demo-block card card-body" id="demo_view_block">
                <canvas id="demo_play_canvas"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="switch">
                <label>
                    Запись
                    <input id="record_switch" type="checkbox">
                    <span class="lever"></span>
                </label>
                <button type="button" id="save_btn" class="btn-sm btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Сохранить запись</button>
            </div>

        </div>
        <div class="col-md-6">
            <!-- ML_TODO: DOWORK Кнопки управления -->
        </div>
    </div>


    <br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="slide-list-block card card-body">
                <div class="thumb icon_list" id="icon_list">
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
</div>
<!--/.Main layout-->



<div class="modal fade right" id="save_lection_record_confirm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalPreviewLabel">Сохранить запись лекции?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Внимание! Ранее сохраненная запись будет перезаписана текущей записью.
            </div>
            <div class="modal-footer">
                <button type="button" data-cofirm="NO" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" data-cofirm="OK" class="btn btn-primary">ОК</button>
            </div>
        </div>
    </div>
</div>

<!---->
<div class="modal fade bottom modal-content-clickable show" id="save_lection_record_success_modal"
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-backdrop="false" style="display: none;" aria-hidden="true"
>
    <div class="modal-dialog modal-frame modal-bottom modal-notify modal-success" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row d-flex justify-content-center align-items-center">
                    <p class="pt-3 pr-2">
                        Запись успешно сохранена, вы можете просмотреть лекцию на странице просмотра
                    </p>
                    <a href="<?=Url::toRoute(['lections/view', 'id' => $id])?>" role="button" class="btn btn-success waves-effect waves-light">Просмотреть
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                    </a>
                    <a type="button" class="btn btn-outline-success waves-effect" data-dismiss="modal">Не сейчас</a>
                </div>
            </div>
        </div>

    </div>
</div>
