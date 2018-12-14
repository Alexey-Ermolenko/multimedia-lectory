<?

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;


$this->title = 'Мультимедиа-лекторий | Новая лекция';

$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li>\n", 'label' => 'Лекции', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Новая лекция';

?>
<script>
    // ML_TODO: видео в модальном окне
    $(document).ready(function () {
        $("[data-modal_video_btn]").click(function () {
            $('#modalYT').attr('data-video_src', $(this).attr('data-video_src'));
        });

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

        $("#modalYT").on('show.bs.modal', function () {
            $("#video").remove();
            $("<video id='video' class='video' controls='controls' poster='' preload='none' style='width: 100%;'></video>").appendTo($("#video_container"));
            $("[data-video_source]").remove();
            $("<source data-video_source src='" + $(this).attr('data-video_src') + "' class='item' type='video/mp4'></source>").appendTo($(".video"));
        });
        $("#modalYT").on('hidden.bs.modal', function () {
            $('video').trigger('pause');
        });
    });
</script>
<!--Main layout-->
<div class="container-fluid">

    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий | Новая лекция</h1>
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
    <br>
    <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Главная', 'url' => '/'],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <br><br>
    <div class="row">
        <!-- Grid column -->
        <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="lection[user_id]" value="<?= Yii::$app->user->identity->getId() ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Название лекции</label>
                        <input name="lection[name]" type="text" class="form-control" id="inputEmail4"
                               placeholder="Название лекции">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Автор лекции</label>
                        <input name="lection[autor]" type="text" class="form-control" id="inputPassword4"
                               placeholder="Автор лекции">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="md-form">
                        <textarea name="lection[description]" type="text" id="text2" placeholder="Описание лекции"
                                  class="md-textarea md-textarea-auto form-control" rows="2"></textarea>
                        <label for="text2">Описание лекции</label>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="md-form">
                        <textarea name="lection[content]" type="text" id="text4" placeholder="Содержимое лекции"
                                  class="md-textarea md-textarea-auto form-control" rows="2"></textarea>
                        <label for="text4">Содержимое лекции</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="md-form">
                            <textarea name="lection[keywords]" type="text" id="text3" placeholder="Ключевые слова"
                                      class="md-textarea md-textarea-auto form-control" rows="2"></textarea>
                            <label for="text3">Ключевые слова</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="md-form">
                            <textarea name="lection[task_group]" type="text" id="text5" placeholder="Целевая группа"
                                      class="md-textarea md-textarea-auto form-control" rows="2"></textarea>
                            <label for="text5">Целевая группа</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="md-form col-md-6 file-field">
                        <label>Загрузить постер</label><br><br>
                        <div class="btn btn-primary btn-sm">
                            <span>Выбрать файл</span>
                            <input name="poster_src" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" value=""
                                   placeholder="Загрузите изображение постера лекции" type="text">
                        </div>
                    </div>
                    <div class="md-form col-md-6 m-b-3">
                        <p class="mr-4 mt-1">Активность</p>
                        <div class="switch round primary-switch text-muted font-small">
                            <label class="mt-3">
                                Выкл.
                                <input name="lection[is_active]"
                                       type="checkbox" <?= (($demoModel->is_active == '1') ? "checked" : "") ?>>
                                <span class="lever"></span>
                                Вкл.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        Мои видео:<br>
                        <div class="scenario_demo-block">
                            <?= GridView::widget([
                                'dataProvider' => $userVideoDataProvider,
                                //'filterModel' => $searchUserDemo,
                                'tableOptions' => [
                                    'class' => 'table table-sm table-striped table-bordered table-hover'
                                ],
                                'layout' => "{sorter}\n{pager}\n{summary}\n{items}",

                                'showHeader' => false,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'autor:ntext',
                                    'create_date:ntext',
                                    'update_date:ntext',
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<a role="button" href="/admin/video/view?id=' . $data['id'] . '" class="btn btn-primary btn-sm">' . $data['name'] . '</a>';
                                        }
                                    ],
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<button data-modal_video_btn data-video_src="' . $data['file_src'] . '" data-video_id="' . $data['id'] . '" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalYT">Просмотр видео</button>';
                                        }
                                    ],
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<div class="form-check">
                                              <input name="lection[video_id]" value="' . $data['id'] . '" type="radio" class="form-check-input" id="materialGroupExample' . $data['id'] . '" name="groupOfMaterialRadios">
                                              <label class="form-check-label" for="materialGroupExample' . $data['id'] . '">Выбрать</label>
                                            </div>';
                                        }
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <br>
                        Общие видео:<br>
                        <div class="scenario_demo-block">
                            <?= GridView::widget([
                                'dataProvider' => $allVideoDataProvider,
                                //'filterModel' => $searchUserDemo,
                                'tableOptions' => [
                                    'class' => 'table table-sm table-striped table-bordered table-hover'
                                ],
                                'layout' => "{sorter}\n{pager}\n{summary}\n{items}",

                                'showHeader' => false,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'name:ntext',
                                    'autor:ntext',
                                    'create_date:ntext',
                                    'update_date:ntext',
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<a role="button" href="/admin/video/view?id=' . $data['id'] . '" class="btn btn-primary btn-sm">' . $data['name'] . '</a>';
                                        }
                                    ],
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<button data-modal_video_btn data-video_src="' . $data['file_src'] . '" data-video_id="' . $data['id'] . '" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalYT">Просмотр видео</button>';
                                        }
                                    ],
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<div class="form-check">
                                              <input name="lection[video_id]" value="' . $data['id'] . '" type="radio" class="form-check-input" id="materialGroupExample' . $data['id'] . '" name="groupOfMaterialRadios">
                                              <label class="form-check-label" for="materialGroupExample' . $data['id'] . '">Выбрать</label>
                                            </div>';
                                        }
                                    ],
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-md">Сохранить</button>
                <button type="reset" class="btn btn-danger btn-md">Сбросить</button>
            </form>
        </div>
        <!-- Grid column -->
    </div>
    <br>
    <?

    Yii::$app->userHelperClass->pre('video');
    ?>

</div>
<!--/.Main layout-->
<!--Modal: modalYT-->
<div class="modal fade" id="modalYT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Body-->
            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half" id="video_container">
                    <video id="video" class="video" controls="controls" poster="" preload="none" style="width: 100%;">

                    </video>
                </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center flex-column flex-md-row">
                <span class="mr-4">Spread the word!</span>
                <div>
                    <a type="button" class="btn-floating btn-sm btn-fb">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <!--Twitter-->
                    <a type="button" class="btn-floating btn-sm btn-tw">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <!--Google +-->
                    <a type="button" class="btn-floating btn-sm btn-gplus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                    <!--Linkedin-->
                    <a type="button" class="btn-floating btn-sm btn-ins">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </div>
                <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">
                    Close
                </button>


            </div>

        </div>
        <!--/.Content-->

    </div>
</div>
<!--Modal: modalYT-->