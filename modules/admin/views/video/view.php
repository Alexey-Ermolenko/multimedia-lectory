<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
//Yii::$app->userHelperClass->pre($JSscript_str);
?>
<script>
$(document).ready(function () {
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
</script>
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
    <?
    /*
    Yii::$app->userHelperClass->pre($searchModel);
    Yii::$app->userHelperClass->pre($dataProvider);
    */
    ?>
    <ul class="nav nav-tabs tabs-light-green darken-1" role="tablist">
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/lections/index/">Лекции</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/lections/slides/">Слайды</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/scenarios/" role="tab">Сценарии</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light active" href="/admin/video/" role="tab">Видео</a>
        </li>
    </ul>
    <br><br>
    <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Главная', 'url' => '/'],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">

        <!--Grid column-->
        <div class="col-md-6 mb-4">
            <!--Card-->
            <div class="card">
                <!--Card content-->
                <div class="card-body">
                    <video id="video" controls="controls" poster="<?=''?>" preload="none" style="width: 100%;">
                        <source src="<?=$video_src?>" type="video/<?=$video_ext?>"/>
                    </video>
                </div>
            </div>
            <!--/.Card-->
        </div>
        <!--Grid column-->
        <!--Grid column-->
        <div class="col-md-6 mb-4">
            <!--Card-->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header text-center">
                    <?=$model->name?>
                </div>
                <!--Card content-->
                <div class="card-body">
                    <p class="text-left">Автор: <?=$model->autor?></p>
                    <p class="text-left">Видим всем: <?=$model->is_visible?></p>
                    <p class="text-left">Активен: <?=$model->is_active?></p>
                    <p class="text-left">Файл:</p> <code class="text-left"><?=$model->file_src?></code>
                    <br><br>
                    <div class="float-left"><p>Дата создания:</p></div>
                    <div class="float-right"><p class="text-monospace"><?=$model->create_date?></p></div>
                    <br><br>
                    <div class="float-left"><p>Дата Последнего обновления:</p></div>
                    <div class="float-right"><p class="text-monospace"><?=$model->update_date?></p></div>

                </div>
            </div>
            <!--/.Card-->

            <!--Card-->
            <div class="card mb-4">
                <!--Card content-->
                <div class="card-body">

                    <!-- List group links -->
                    <div class="list-group list-group-flush">
                        <p>
                            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(Yii::t('app', 'Delete'), ['del', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                    </div>
                    <!-- List group links -->

                </div>

            </div>
            <!--/.Card-->

        </div>
        <!--Grid column-->
    </div>

    <br>
    <br>
    <br>
</div>
<!--/.Main layout-->
