<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use app\components\UserHelperClass;
use app\components\YouTubeVideo;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if ($model['file_src'])
{
    if ((stristr($model['file_src'], 'youtu') === FALSE) && (stristr($model['file_src'], 'youtube') === FALSE))
    {
        // Видео из репозитория лектория
        $video_ext = pathinfo($model['file_src'])['extension'];

        ob_start();
        ?>
        <video id="video" controls="controls" poster="<?=''?>" preload="none" style="width: 100%;">
            <source src="<?=$model['file_src']?>" type="video/<?=$video_ext?>"/>
        </video>
        <?

        $videoHtml = ob_get_contents();
        ob_end_clean();
    }
    else
    {
        // Видео из youtube
        ob_start();

        YoutubeVideo::insertHTMLVideo($model['file_src'], '100%', '390');

        $videoHtml = ob_get_contents();
        ob_end_clean();
    }

}
?>
<script>
$(document).ready(function () {

});
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
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
    <br><br><br>
    <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Главная', 'url' => '/'],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
        <?
        if($videoHtml)
        {
            ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <?=$videoHtml?>
                    </div>
                </div>
            </div>
            <?
        }
        ?>
        <div class="col-md-6 mb-4">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <?=$model->name?>
                </div>
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
            <div class="card mb-4">
                <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>
