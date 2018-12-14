<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;

$this->title = 'Лекция №'.$model->id.' | редактирование';
?>

<!--Main layout-->
<div class="container-fluid">

    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий </h1>
        </div>
    </div>
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
    <br><br><br>
    <p>Редактирование лекции:</p>
    <h4 class="h4-responsive"><?=$model->name?></h4>


    <form>
        <div class="col-md-6 mb-4 pt-4">

                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" id="name" class="form-control-sm">
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <textarea type="text" id="description" class="form-control md-textarea" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords">keywords</label>
                    <textarea type="text" id="keywords" class="form-control md-textarea" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="autor">autor</label>
                    <input type="text" id="autor" class="form-control-sm">
                </div>
                <div class="form-group">
                    <div class="switch">
                        <label>
                            Активность Выкл.
                            <input checked="checked" type="checkbox">
                            <span class="lever"></span> Вкл.
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="md-form file-field">
                        <div class="btn btn-primary btn-sm">
                            <span>Выбрать Видео</span>
                            <input value="upload/users/4/avatar.jpg" name="video" type="file">
                        </div>
                        <div class="file-path-wrapper"></div>
                    </div>
                </div>
        </div>
    </form>
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

    ?>


</div>
<!--/.Main layout-->
