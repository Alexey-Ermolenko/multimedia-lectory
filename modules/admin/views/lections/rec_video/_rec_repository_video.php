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

$this->registerJsFile('/modules/admin/web/js/jquery.imageLens.js',
    [
        'position' => \yii\web\View::POS_END,
        'depends'=>'app\assets\AdminAsset'
    ]
);

$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li>\n",'label' => 'Лекции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li>\n",'label' => 'Запись', 'url' => ['rec', 'id' => $lectionModel['id']]];


$arLection = [
    'video'=> ArrayHelper::toArray($video),
    'demonstrations'=> ArrayHelper::toArray($arDemos),
];
$json = json_encode($arLection, JSON_UNESCAPED_UNICODE);

# Yii::$app->userHelperClass->pre($arLection);
# Yii::$app->userHelperClass->pre($arScenarios);


//ML_TODO: запись комманд


if ($video['file_src'])
{
    $video_src = $video['file_src'];
    $video_ext = pathinfo($video['file_src'])['extension'];
}

?>

<script>
    var json = <?=$json?>;

    isREC = false;
    currentDemo = null;

    $_GET = window.location.search.replace('?','').split('&').reduce(function(p,e) {
        var a = e.split('=');
        p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
        return p;
    }, {});

    $(document).ready(function(){
        video = document.getElementById("video");

        $('#record_switch').on('change', function(){

            if ($('#record_switch').prop('checked'))
            {
                isREC = true;
                alert("Внимание! Включен режим записи лекции");
                video.play();
                demosList = [];
                comandList = [];
            }
            else
            {
                var isCancelled = confirm("Вы действительно хотите отменить запись?");
                cancelRecording(isCancelled);
            }
        });

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
                    currentDemo = $(this).attr('src');
                    drawSlide($(this).attr('src'));
                    addDemo($(this).attr('data-slider_id'), curTime);
                }
                else
                {
                    console.log("no slide type");
                }
            }

        });

        //При обновлении времени воспроизведения видео
        $("#video").on("timeupdate", function(event){
            onTrackedVideoFrame(this.currentTime, this.duration);
        });

        function onTrackedVideoFrame(currentTime, duration)
        {
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

        //Обработка модального окна подтверждения сохранения записи
        $('#save_lection_record_confirm_modal [data-cofirm="NO"]').click(function(){
            video.play();
        });

        $('#save_lection_record_confirm_modal [data-cofirm="OK"]').click(function(){

            // Запись списка демонстрации
            // Запись списка команд
            $.ajax({
                url: '/admin/lections/rec-video?id=' + $_GET['id']+'&idscn='+ $_GET['idscn'],
                type: "POST",
                dataType: "json",
                data: "jsonDemosList=" + JSON.stringify(demosList) + "&jsonComandList=" + JSON.stringify(comandList),
                success: function (data) {
                    if(data.result == "ok")
                    {
                        $('#save_lection_record_confirm_modal').modal('hide');
                        $('#save_lection_record_success_modal').modal('show');
                        cancelRecording(true);
                    }
                    else
                    {
                        alert('Recording fail!!! please repeat');
                    }
                }
            });

        });

        //Обработка нажатия кнопок для записи команд для демонстрационного объекта
        $(document).delegate('#rec_comands_btns_group [data-color="black"]', 'click', function(e){
            console.log('black');
            changeColor('#000', this);
        });
        $(document).delegate('#rec_comands_btns_group [data-color="red"]', 'click', function(e){
            console.log('red');
            changeColor('#f00', this);
        });
        $(document).delegate('#rec_comands_btns_group [data-color="blue"]', 'click', function(e){
            console.log('blue');
            changeColor('#00f', this);
        });
        $(document).delegate('#rec_comands_btns_group [data-color="green"]', 'click', function(e){
            console.log('green');
            changeColor('#0f0', this);
        });
        $(document).delegate('#rec_comands_btns_group [data-zoom]', 'click', function(e){
            console.log('data-zoom');
            zoomSlide();
        });
        $(document).delegate('#rec_comands_btns_group [data-clear]', 'click', function(e){
            console.log('data-clear');
            clearCanvas();
        });

        function drawSlide(slideSrc)
        {
            var canvas = document.getElementById("demo_play_canvas");
            ctx = canvas.getContext('2d');
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
            var pic = new Image();
            pic.src = slideSrc;

            //Запрет на рисование
            dctrl = { drawing: false };
            //События мышки
            canvas.addEventListener("mousedown", canvas_mousedown);
            canvas.addEventListener("mousemove", canvas_mousemove);
            canvas.addEventListener("mouseup", canvas_mouseup);
            //Размер картинки
            var y = canvas.height;
            var x = canvas.width;
            ctx.drawImage(pic, 0, 0, canvas.width, canvas.height);
        }

        function canvas_mouseup(event)
        {
            dctrl.drawing = false;
        }

        function canvas_mousemove(event)
        {
            if(dctrl.drawing == true)
            {
                //Получаем координаты
                var rect = event.target.getBoundingClientRect();
                var mousex = event.clientX - rect.left;
                var mousey = event.clientY - rect.top;
                //Рисуем линию
                draw_line(dctrl.prevx, dctrl.prevy, mousex, mousey);
                dctrl.prevx = mousex;
                dctrl.prevy = mousey;
            }
        }

        function canvas_mousedown(event)
        {
            var rect = event.target.getBoundingClientRect();
            dctrl.drawing = true;
            draw_line();
            dctrl.prevx = event.clientX - rect.left;
            dctrl.prevy = event.clientY - rect.top;
        }

        function changeColor(color, imgElem)
        {
            ctx.strokeStyle = color;
            // 	Меняем текущий цвет рисования
            //context.strokeStyle = color;

            // Меняем стиль элемента <img>, по которому щелкнули

            // Возвращаем ранее выбранный элемент <img> в нормальное состояние
        }

        function clearCanvas()
        {
            var canvas = document.getElementById("demo_play_canvas");
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            var pic = new Image();
            pic.src = currentDemo;
            ctx.drawImage(pic, 0, 0, canvas.width, canvas.height);
            //Запись об чистке слайда
            sendClearSlideCommand();
        }

        /*
        ML_TODO: Zoom
        function zoomSlide()
        {
            var canvas = document.getElementById("demo_play_canvas");
            if (canvas.getContext)
            {
                //Заполнение canvas для лупы
                canvasLoop = document.getElementById("canvasLoop");
                var ctxL = canvasLoop.getContext('2d');
                var picL = new Image();
                picL.src = canvas.toDataURL("image/png");
                canvasLoop.width=canvas.width*2;
                canvasLoop.height=canvas.height*2;
                //Получение картинки из canvas для лупы
                picL.onload=function()
                {
                    var yL= canvasLoop.height;
                    var xL= canvasLoop.width;
                    ctxL.drawImage(picL, 0, 0, xL, yL);
                    $("#demo_play_canvas").imageLens({ lensSize: 200, borderSize: 8, borderColor: '#fofof', lensCss: "zoom" });
                }
            }
        }
        */

        //Рисуем линию
        function draw_line(x1, y1, x2, y2)
        {
            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y2);
            ctx.stroke();
            //Запись о рисовании
            sendDrawCommand(x1,y1,x2,y2,ctx.strokeStyle, );
        }

    });

    //удобое представление времени
    var timeFormat = (function (){
        function num(val)
        {
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
            comandList = [];
            $('#record_switch').prop('checked', false);
        }
        else
        {
            $('#record_switch').prop('checked', true);
        }
    }

    /*
    * Запись команды чистки слайда
    * */
    function sendClearSlideCommand()
    {
        if (isREC==true)
        {
            comandList.push({command: "clear_slide", time: curTime});
        }
    }

    /*
    * Запись команды рисования
    * */
    function sendDrawCommand(x1, y1, x2, y2, color)
    {
        if (isREC==true)
        {
            var canvas = document.getElementById("demo_play_canvas");
            var wCanvas = canvas.width;
            var hCanvas = canvas.height;
            comandList.push({
                command: "draw_line",
                wCanvas: wCanvas,
                hCanvas: hCanvas,
                x1:x1,
                y1:y1,
                x2:x2,
                y2:y2,
                color: color,
                time: curTime
            });
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
                <button type="button" id="save_btn" class="btn-sm btn btn-success">
                    <i class="fa fa-save" aria-hidden="true"></i> Сохранить запись
                </button>
            </div>

        </div>
        <div class="col-md-6">
            <!-- ML_TODO: DOWORK Кнопки управления -->
            <div class="card" id="rec_comands_btns">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example" id="rec_comands_btns_group">
                    <button type="button" class="btn btn-block btn-elegant btn-sm" data-color="black">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-block btn-danger btn-sm" data-color="red">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-block btn-indigo btn-sm" data-color="blue">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-block btn-light-green btn-sm" data-color="green">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </button>
                    <!--
                    <button type="button" class="btn btn-block btn-mdb-color btn-sm" data-zoom>
                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </button>
                    -->
                    <button type="button" class="btn btn-block btn-mdb-color btn-sm" data-clear>
                        <i class="fa fa-remove" aria-hidden="true"></i>
                    </button>
                </div>

            </div>
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
