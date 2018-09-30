<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;

use yii\helpers\ArrayHelper;
$this->title = 'Запись лекции с видео';

# $arLection = ArrayHelper::toArray($model);
# $arScenarios = ArrayHelper::toArray($scenarioDataProvider->getModels());
# Yii::$app->userHelperClass->pre($arLection);
# Yii::$app->userHelperClass->pre($arScenarios);
?>
<script>
$(document).ready(function() {

});
</script>
<!--Main layout-->
<div class="container-fluid">
    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий </h1>
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

    <?
    Yii::$app->userHelperClass->pre('rec video');
    Yii::$app->userHelperClass->pre(ArrayHelper::toArray($lectionModel));
    Yii::$app->userHelperClass->pre(ArrayHelper::toArray($arDemos));
    ?>
    <hr>

    <div class="demo-list-view">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
    <br>
    <br>
</div>
<!--/.Main layout-->
