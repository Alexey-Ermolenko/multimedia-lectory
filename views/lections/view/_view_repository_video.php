<?php

use app\components\userHelperClass;

$this->title = 'Мультимедиа-лекторий | '. $model['lection_name'];
$this->registerMetaTag(['name' => 'keywords', 'content' => $model['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $model['description']]);

$arLection = [
    'video'=> $model,
    'demonstrations'=> $demonstrations_model,
    'commands' => [
        [
            'id' => '1',
            'lection_id' => '1',
            'cmd'=> 'www2',
            'time'=> '14',
        ],
        [
            'id' => '2',
            'lection_id' => '1',
            'cmd'=> 'www2',
            'time'=> '23',
        ],
        [
            'id' => '3',
            'lection_id' => '1',
            'cmd'=> 'wwww',
            'time'=> '58',
        ]
    ],
];
$json = json_encode($arLection, JSON_UNESCAPED_UNICODE);

//Yii::$app->userHelperClass->pre($json);

//ML_TODO: вывод слайдов
//ML_TODO: массив json
//ML_TODO: синхронизация слайдов с видео


if ($model['file_src'])
{
    $video_src = $model['file_src'];

    if ((stristr($model['file_src'], 'youtu') === FALSE) && (stristr($model['file_src'], 'youtube') === FALSE))
    {
        $JSscript_str = '';
        $video_ext = pathinfo($model['file_src'])['extension'];

    }
    else
    {
        $video_ext = "mp4";
        $JSscript_str = app\components\VideoConverter::getYoutubeVideoData($model['file_src']);
    }
}
?>
<script>
    $(document).ready(function(){
        var json = <?=$json?>;


        console.log('json');
        console.log(json.demonstrations.length);
        console.log(json.commands.length);


        //добавляем иконки из списка json
        for (var i = 0; i < json.demonstrations.length; i++)
        {
            $('<div class="demo-icon-item"></div>')
                .append('<img data-src="" ' +
                    'class="img-rounded icon_item" ' +
                    'id="'+json.demonstrations[i].id+'"' +
                    'alt="'+json.demonstrations[i].id+'" ' +
                    'data-slide_time="'+json.demonstrations[i].time+'"'+
                    'data-slider_id="'+json.demonstrations[i].id+'" '+
                    'src="'+json.demonstrations[i].src+'">' +
                    '<span>'+timeFormat(Math.round(json.demonstrations[i].time))+'</span>')
                .appendTo('.icon_list');

        }

        //переключение слайда по клику
        $(document).delegate('.icon_item','click', function () {
            console.log($(this).data('slider_id'));
            console.log($(this).data('slide_time'));
            console.log($(this).attr('src'));
            var video = document.getElementById("video");
            video.play();
            video.currentTime = $(this).data('slide_time');

            $('.icon_item').css('border', '1px solid #000000;');
        });


        $("#video").on("timeupdate", function(event){
            onTrackedVideoFrame(this.currentTime, this.duration);
        });
        function onTrackedVideoFrame(currentTime, duration){
            $("#current").text(currentTime); //Change #current to currentTime
            $("#duration").text(duration);


            //переключение демонстрациий по текущему времени видео
            //вывод демонстрациии
            for (var i = 0; i < json.demonstrations.length; i++)
            {
                if (json.demonstrations[i].time <= currentTime)
                {
                    // console.clear();
                    console.log('слайд = '+ json.demonstrations[i].id);

                    var canvas = document.getElementById("demo_play_canvas");
                    ctx = canvas.getContext('2d');

                    canvas.width = canvas.offsetWidth;
                    canvas.height = canvas.offsetHeight;

                    var pic = new Image();
                    pic.src = json.demonstrations[i].src;


                    ctx.drawImage(pic, 0, 0, canvas.width, canvas.height);

                    $('.icon_item').css('border', '1px solid #000000');
                    $('#'+json.demonstrations[i].id).css('border', '3px solid #ff0000');

                }
            }

            //выполнение команды по текущему времени видео
        }

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

</script>
<!--Main layout-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive"><?=$model['lection_name']?>
                <small class="text-muted"><?=$model['lection_autor']?></small>
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-<?=!empty($arLection['demonstrations']) ? "6":"8" ?>">
            <div class="embed-responsive embed-responsive-16by9">
                <video id="video" controls="controls" poster="<?=$model['poster']?>" preload="none">
                    <source src="<?=$video_src?>" type="video/<?=$video_ext?>"/>
                </video>
                <!--
                <video id="video" controls="" poster="/repository/user/lections/1/1342067789683.jpg" preload="none">
                    <source src="/repository/user/video/1/martynko.mp4" type="video/mp4">
                    <source src="/repository/user/video/1/martynko.webm" type="video/webm">
                </video>
                -->
            </div>
        </div>
        <?
        if(!empty($arLection['demonstrations']))
        {
            ?>
            <div class="col-md-6">
                <div class="demo-block card card-body" id="demo_view_block">
                    <canvas id="demo_play_canvas"></canvas>
                </div>
            </div>
            <?
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Просмотров: <?=$model['view_count']?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?
            if(!empty($arLection['demonstrations']))
            {
                ?>
                <div class="slide-list-block card card-body">
                    <div class="thumb icon_list" id="icon_list">
                    </div>
                </div>
                <?
            }
            if($model['content'])
            {
                ?>
                <div class="lection-description-block card card-body">
                    <p><?=$model['content']?></p>
                </div>
                <?
            }
            ?>

            <div class="other-lections-block card card-body">
                <p>Похожие лекции</p>
            </div>
        </div>

    </div>
</div>
<!--/.Main layout-->
