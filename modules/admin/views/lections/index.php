<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;

$this->title = 'Лекции пользователя';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий </h1>
        </div>
    </div>
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
    <a href="/admin/lections/new-lection/" class="btn btn-primary btn-lg">
        <i class="fa fa-bolt"></i> Создать новую лекцию
    </a>
    <br><br><br>
    <?

        if($userLectionDataProvider != null)
        {
            //Yii::$app->userHelperClass->pre($userLectionDataProvider->getModels());
            ?>
            <div class="col-md-12">
                <h2>Лекции пользователя:</h2>
                <?= GridView::widget([
                    'dataProvider' => $userLectionDataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-sm table-striped table-bordered table-hover'
                    ],
                    'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",

                    'showHeader'=>TRUE,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name:ntext',
                        //'description:ntext',
                        'keywords:ntext',
                        //'content:ntext',
                        'task_group:ntext',
                        'autor:ntext',
                        'is_active:ntext',
                        'created_date:ntext',

                        [
                            'label' => 'Картинка',
                            'format' => 'raw',
                            'value' => function($data){
                                return Html::img( Url::to($data['poster'], true),[
                                    'alt'=>'poster',
                                    'style' => 'width:65px;'
                                ]);
                            },
                        ],
                        // 'created_at',
                        // 'updated_at',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header'=>'Действия',
                            'headerOptions' => ['width' => '150'],
                            'template' => '{view}<br>{record}<br>{export}<br>{update}<br>{delete}',
                            'buttons' => [
                                'view' => function ($data, $key, $index) {
                                    return Html::a(
                                        '<i class="fa fa-eye"></i> Просмотр',
                                        ['lections/view?id='.$key['id']],
                                        [
                                            'class' => 'btn btn-sm btn-primary',
                                        ]
                                    );
                                },
                                'record' => function ($data, $key, $index) {
                                    return Html::a(
                                        '<i class="fa fa-play"></i> Запись',
                                        ['lections/rec?id='.$key['id']],
                                        [
                                            'class' => 'btn btn-sm btn-success',
                                        ]
                                    );
                                },
                                'export' => function ($data, $key, $index) {
                                    return Html::a(
                                        '<i class="fa fa-cloud-download" aria-hidden="true"></i> Экспорт',
                                        ['lections/export?id='.$key['id']],
                                        [
                                            'class' => 'btn btn-sm btn-secondary',
                                        ]
                                    );
                                },
                                'update' => function ($data, $key, $index) {
                                    return Html::a(
                                        '<i class="fa fa-edit"></i> Обновить',
                                        ['lections/edit?id='.$key['id']],
                                        [
                                            'class' => 'btn btn-sm btn-warning',
                                        ]
                                    );
                                },
                                'delete' => function ($data, $key, $index) {
                                    //ML_TODO: confirm для удаления
                                    return Html::a(
                                        '<i class="fa fa-remove"></i> Удалить',
                                        ['lections/del?id='.$key['id']],
                                        [
                                            'class' => 'btn btn-sm btn-danger',
                                            'onclick'=>'confirm("Удалить лекцию?");'
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
            <?
        }
        if($allLectionDataProvider != null)
        {
            //Yii::$app->userHelperClass->pre($allLectionDataProvider->getModels());
            ?>
            <div class="col-md-12">
                <h2>Все лекции:</h2>
                <?= GridView::widget([
                    'dataProvider' => $allLectionDataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-sm table-striped table-bordered table-hover'
                    ],
                    'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",

                    'showHeader'=>TRUE,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name:ntext',
                        //'description:ntext',
                        'keywords:ntext',
                        //'content:ntext',
                        'task_group:ntext',
                        'autor:ntext',
                        'is_active:ntext',
                        'created_date:ntext',
                        [
                            'label' => 'Картинка',
                            'format' => 'raw',
                            'value' => function($data){
                                return Html::img( Url::to($data['poster'], true),[
                                    'alt'=>'poster',
                                    'style' => 'width:65px;'
                                ]);
                            },
                        ],
                        // 'created_at',
                        // 'updated_at',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header'=>'Действия',
                            'headerOptions' => ['width' => '150'],
                            'template' => '{view}<br>{export}',
                            'buttons' => [
                                'view' => function ($data, $key, $index) {
                                    return Html::a(
                                        '<i class="fa fa-eye"></i> Просмотр',
                                        ['lections/view?id='.$key['id']],
                                        [
                                            'class' => 'btn btn-sm btn-primary',
                                        ]
                                    );
                                },
                                'export' => function ($data, $key, $index) {
                                    return Html::a(
                                        '<i class="fa fa-cloud-download" aria-hidden="true"></i> Экспорт',
                                        ['lections/export?id='.$key['id']],
                                        [
                                            'class' => 'btn btn-sm btn-secondary',
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
            <?
        }
    ?>
</div>
