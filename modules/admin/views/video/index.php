<?php
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Мультимедиа-лекторий | Видео');
$this->params['breadcrumbs'][] = "Видео";
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
            <h1 class="h1-responsive">Мультимедиа-лекторий | Видео</h1>
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
    <br>
    <a href="/admin/video/create/" class="btn btn-primary btn-lg">
        <i class="fa fa-plus"></i> <?=Yii::t('app', 'Загрузить видео')?>
    </a>
    <br>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-md-12">
        <h2>Видео пользователя:</h2>
        <div class="scenario_demo-block">
            <?= GridView::widget([
                'dataProvider' => $userVideoDataProvider,
                //'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-sm table-striped table-bordered table-hover'
                ],
                'layout' => "{sorter}\n{pager}\n{summary}\n{items}",

                'showHeader' => true,
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
                            return '<button data-modal_video_btn data-video_src="' . $data['file_src'] . '" data-video_id="' . $data['id'] . '" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalYT">Просмотр видео</button>';
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Действия',
                        'headerOptions' => ['width' => '225'],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($key, $data, $index) {
                                return Html::a(
                                    '<i class="fa fa-eye"></i>',
                                    ['/admin/video/view?id='.$data['id']],
                                    [
                                        'class' => 'btn btn-sm btn-primary',
                                    ]
                                );
                            },
                            'update' => function ($key, $data, $index) {
                                return Html::a(
                                    '<i class="fa fa-edit"></i>',
                                    ['/admin/video/update?id='.$data['id']],
                                    [
                                        'class' => 'btn btn-sm btn-primary',
                                    ]
                                );
                            },
                            'delete' => function ($key, $data, $index) {
                                //ML_TODO: confirm для удаления
                                return Html::a(
                                    '<i class="fa fa-remove"></i>',
                                    ['/admin/video/delele?id='.$data['id']],
                                    [
                                        'class' => 'btn btn-sm btn-danger',
                                        'onclick'=>'confirm("Удалить слайд?");'
                                    ]
                                );
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
    <?
    if($allVideoDataProvider !== null)
    {
        ?>
        <br>
        <div class="col-md-12">
            <h2>Общее видео:</h2>
            <div class="scenario_demo-block">
                <?= GridView::widget([
                    'dataProvider' => $allVideoDataProvider,
                    //'filterModel' => $searchUserDemo,
                    'tableOptions' => [
                        'class' => 'table table-sm table-striped table-bordered table-hover'
                    ],
                    'layout' => "{sorter}\n{pager}\n{summary}\n{items}",

                    'showHeader' => true,
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
                                return '<button data-modal_video_btn data-video_src="' . $data['file_src'] . '" data-video_id="' . $data['id'] . '" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalYT">Просмотр видео</button>';
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header'=>'Действия',
                            'headerOptions' => ['width' => '125'],
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($key, $data, $index) {
                                    return Html::a(
                                        '<i class="fa fa-eye"></i>',
                                        ['/admin/video/view?id='.$data['id']],
                                        [
                                            'class' => 'btn btn-sm btn-primary',
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
        <?
    }
    ?>
    <br><br><br>
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
                <!--
                <span class="mr-4">Spread the word!</span>
                <div>
                <a type="button" class="btn-floating btn-sm btn-fb">
                    <i class="fa fa-facebook"></i>
                </a>
                <a type="button" class="btn-floating btn-sm btn-tw">
                    <i class="fa fa-twitter"></i>
                </a>
                <a type="button" class="btn-floating btn-sm btn-gplus">
                    <i class="fa fa-google-plus"></i>
                </a>
                <a type="button" class="btn-floating btn-sm btn-ins">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
                -->
                <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">
                    Close
                </button>


            </div>

        </div>
        <!--/.Content-->

    </div>
</div>
<!--Modal: modalYT-->