<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;
use app\components\YouTubeVideo;
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

//ML_TODO: DOWORK просмотр лекции в админке; воспроизведение команд


if ($model['file_src'])
{

    $video_src = $model['file_src'];
    // Видео из youtube
    ob_start();

    YoutubeVideo::insertHTMLVideo($model['file_src'], '100%', '390');
    $videoHtml = ob_get_contents();

    ob_end_clean();
}
?>
<script>
    var video_src = "<?=$video_src?>";
    var json = <?=$json?>;
    video = null;
    currentDemo = null;

    function youtube_parser(url) {
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        var match = url.match(regExp);
        return (match && match[7].length == 11) ? match[7] : false;
    }


    var time_update_interval = 0;

    function onYouTubeIframeAPIReady() {
        window.video = new YT.Player('player', {

            events: {
                'onStateChange': onPlayerStateChange,
                'onReady': initialize
            }
        });
    }

    function onPlayerStateChange() {
        console.log('onPlayerStateChange');
    }

    function initialize() {
        updateTimerDisplay();

        clearInterval(time_update_interval);
        time_update_interval = setInterval(function () {
            updateTimerDisplay();

        }, 1000)
    }

    function updateTimerDisplay() {
        //   $('#current-time').text((video.getCurrentTime()));
        //   $('#duration').text((video.getDuration()));

        curTime = video.getCurrentTime();
        durTime = video.getDuration();

        onTrackedVideoFrame(curTime, durTime);
    }


    $(document).ready(function(){

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
            video.playVideo();
            video.seekTo($(this).data('slide_time'),true);
            $('.icon_item').css('border', '1px solid #000000;');
        });
    });

    function onTrackedVideoFrame(currentTime, duration){
        $("#current-time").text(currentTime); //Change #current to currentTime
        $("#duration").text(duration);


        //переключение демонстрациий по текущему времени видео
        //вывод демонстрациии
        for (var i = 0; i < json.demonstrations.length; i++)
        {
            if (json.demonstrations[i].time <= currentTime)
            {
                // console.clear();
                //console.log('слайд = '+ json.demonstrations[i].id);

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
            <div class="embed-responsive embed-responsive-16by9" id="video_container">
                <?=$videoHtml?>
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
