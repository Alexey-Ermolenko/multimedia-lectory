<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;

$this->title = 'Лекции пользователя';
?>

<!--Main layout-->
<div class="container-fluid">

    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий </h1>
        </div>
    </div>
    <hr>
    <!--/.Page heading-->
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

    <br>
    <br>
    <br>
    <?
    Yii::$app->userHelperClass->pre($model->id);
    Yii::$app->userHelperClass->pre($model->user_id);
    Yii::$app->userHelperClass->pre($model->video_id);
    Yii::$app->userHelperClass->pre($model->name);
    Yii::$app->userHelperClass->pre($model->description);
    Yii::$app->userHelperClass->pre($model->keywords);
    Yii::$app->userHelperClass->pre($model->content);
    Yii::$app->userHelperClass->pre($model->task_group);
    Yii::$app->userHelperClass->pre($model->autor);
    Yii::$app->userHelperClass->pre($model->is_active);
    Yii::$app->userHelperClass->pre($model->created_date);
    Yii::$app->userHelperClass->pre($model->update_date);
    Yii::$app->userHelperClass->pre($model->poster);
    /*

    Yii::$app->userHelperClass->pre($searchModel);
    Yii::$app->userHelperClass->pre($dataProvider);
    */
    ?>


</div>
<!--/.Main layout-->
