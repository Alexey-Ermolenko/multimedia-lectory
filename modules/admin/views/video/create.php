<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = Yii::t('app', 'Create Video');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    $(document).ready(function () {

        $("#video_src").change(function() {

            var videoSrc = $(this).prop("checked");

            if(videoSrc === false)
            {
                $("#youtube_video").show();
                $("#file_video").hide();
            }
            else
            {
                $("#youtube_video").hide();
                $("#file_video").show();
            }
        });

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
    <div class="row wow fadeIn mt-6">
        <div class="col-md-10">
            <form enctype="multipart/form-data" action="" method="post" class="card border border-light p-5 float-left">
                <input name="_csrf" value="Vx0GLpzM1EfO2xKrB9Z-B9wAMbcs2JC6rCTiL9VbILcbeWJZ_56YIpesSJNzlVMy6W964lWR39fvddFcvG8T0g==" type="hidden">
                <input name="Video[user_id]" value="<?=Yii::$app->user->identity->getId()?>" type="hidden">
                <div class="form-row">
                    <div class="col">
                        <div class="md-form form-group">
                            <input name="Video[name]" type="text" class="form-control" id="inputAddressMD" placeholder="Название видео">
                            <label for="inputAddressMD">name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form form-group">
                            <input name="Video[autor]" type="text" class="form-control" id="inputAddressMD" placeholder="Имя автора видео">
                            <label for="inputAddressMD">autor</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="switch">
                            <label class="mt-2">
                                Активность
                                <input name="Video[is_active]" type="checkbox" checked="checked">
                                <span class="lever"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="switch">
                            <label class="mt-2">
                                Видимость
                                <input name="Video[is_visible]" type="checkbox" checked="checked">
                                <span class="lever"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="switch">
                            <label class="mt-2">
                                Видео youtube
                                <input id="video_src" type="checkbox" checked="checked">
                                <span class="lever"></span>
                                Из файла
                            </label>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="form-row" id="youtube_video" style="display: none">
                    <div class="col-md-12">
                        <div class="md-form form-group">
                            <input name="Video[video_url]" type="text" class="form-control" id="inputAddressMD" placeholder="Ссылка на видео с youtube">
                            <label for="inputAddressMD">Видео с youtube</label>
                        </div>
                    </div>
                </div>

                <div class="form-row" id="file_video">
                    <div class="col-md-12">
                        <div class="file-field">
                            <div class="btn btn-primary btn-sm">
                                <i class="fa fa-cloud-upload ml-3" aria-hidden="true"></i> <span>Choose files</span>
                                <input name="file_src" type="file" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Видео файл">
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="form-row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?/*= $this->render('_form', ['model' => $model])*/?>
</div>
<!--/.Main layout-->

