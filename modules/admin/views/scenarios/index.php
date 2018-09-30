<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScenariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



use yii\grid\GridView;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;

$this->title = 'Сценарии пользователя';
?>

<!--Main layout-->
<div class="container-fluid">

    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий | Сценарии</h1>
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
            <a class="nav-link waves-light active" href="/admin/scenarios/" role="tab">Сценарии</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/video/" role="tab">Видео</a>
        </li>
    </ul>
    <br>
    <br>
    <br>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <a href="/admin/scenarios/new-scenario/" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Создать новый Сценарий</a>
    <br><br>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_list_item',
        'layout' => "{pager}\n{summary}\n{items}\n{pager}",
        'summary' => 'Показано {count} из {totalCount}',
        'summaryOptions' => [
            'tag' => 'span',
            'class' => 'my-summary'
        ],
        'emptyText' => 'Список пуст',
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'nextPageLabel' => 'next',
            'prevPageLabel' => 'previous',
            'maxButtonCount' => 3,
        ],
    ]) ?>
</div>
<!--/.Main layout-->

