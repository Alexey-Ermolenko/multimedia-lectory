<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\DemonstrationsSearch;
use app\models\User;
use yii\helpers\Url;
$this->title = 'Новый слайд';
?>
<script>
    $(document).ready(function() {
        $('.mdb-select').material_select();
    });
</script>
<div class="container-fluid">


    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий | Новый слайд</h1>
        </div>
    </div>

    <hr>
    <ul class="nav nav-tabs tabs-light-green darken-1" role="tablist">
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/lections/index/">Лекции</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light active" href="/admin/lections/slides/">Слайды</a>
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
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="/admin/lections/slides/" role="button">
                <i class="fa fa-reply" aria-hidden="true"></i> К списку слайдов
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <input name="demo[user_id]" value="<?=Yii::$app->user->identity->getId()?>" type="hidden">
                    <div class="card add-slide-form">
                        <div class="md-form col-md-4 m-b-3">
                            <select class="mdb-select" name="demo[type]">
                                <option value="slide" data-icon="/web/img/slide.jpg" class="rounded-circle">slide</option>
                                <option value="3D" data-icon="/web/img/3D.jpg" class="rounded-circle">3D</option>
                                <option value="TEST_TYPE" data-icon="/web/img/TEST_TYPE.jpg" class="rounded-circle">TEST TYPE</option>
                            </select>
                            <label>Тип демонстрационного объекта</label>
                        </div>
                        <div class="md-form col-md-4 m-b-3">
                            <label>Название</label>
                            <input id="form3" name="demo[name]" class="form-control" value="" type="text">
                        </div>
                        <div class="md-form col-md-4 m-b-3">
                            <label>Автор</label>
                            <input id="form2" name="demo[autor]" class="form-control" value="" type="text">
                        </div>
                        <div class="md-form col-md-4 m-b-3">
                            <p class="mr-4 mt-1">Активность</p>
                            <div class="switch round primary-switch text-muted font-small">
                                <label class="mt-2">
                                    Off
                                    <input name="demo[is_active]" type="checkbox" checked="checked">
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                        <div class="md-form col-md-4 m-b-3">
                            <p class="mr-4 mt-1">Видимость всем</p>
                            <!-- Switch -->
                            <div class="switch round primary-switch text-muted font-small">
                                <label class="mt-2">
                                    Off
                                    <input name="demo[is_visible]" type="checkbox" checked="checked">
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>

                    </div>


                    <div class="md-form file-field">
                        <label>Загрузить иконку демонстрационного объекта</label><br><br>
                        <div class="btn btn-primary btn-sm">
                            <span>Выбрать файл</span>
                            <input name="icon_src" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" value="" placeholder="Загрузите изображение пользователя" type="text">
                        </div>
                    </div>


                    <div class="md-form file-field">
                        <label>Загрузить файл демонстрационного объекта</label><br><br>
                        <div class="btn btn-primary btn-sm float-left">
                            <span>Выбрать файл</span>
                            <input name="content_src" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" value="" placeholder="Upload your file">
                        </div>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-success">Загрузить <i class="fa fa-paper-plane-o ml-1"></i></button>
                    </div>
                </form>

        </div>

    </div>



</div>

