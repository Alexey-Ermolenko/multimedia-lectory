<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = Yii::t('app', 'Update Video');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
                            <input name="Video[name]" type="text" class="form-control" value="<?=$model->name?>" id="inputAddressMD" placeholder="Название видео">
                            <label for="inputAddressMD">name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form form-group">
                            <input name="Video[autor]" type="text" class="form-control" value="<?=$model->autor?>" id="inputAddressMD" placeholder="Имя автора видео">
                            <label for="inputAddressMD">autor</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="switch">
                            <label class="mt-2">
                                Активность
                                <input name="Video[is_active]" type="checkbox" <?=(($model->is_active=='1') ? "checked": "")?>>
                                <span class="lever"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="switch">
                            <label class="mt-2">
                                Видимость
                                <input name="Video[is_visible]" type="checkbox" <?=(($model->is_visible=='1') ? "checked": "")?>>
                                <span class="lever"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="file-field">
                            <div class="btn btn-primary btn-sm">
                                <i class="fa fa-cloud-upload ml-3" aria-hidden="true"></i> <span>Choose files</span>
                                <input name="file_src" value="" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" value="<?=$model->file_src ?>" type="text" placeholder="Видео файл">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?/*= $this->render('_form', ['model' => $model])*/?>
</div>
<!--/.Main layout-->

