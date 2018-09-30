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

    <br>
    <br>
    <br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
                    return Html::img( Url::to($data->poster, true),[
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
                'headerOptions' => ['width' => '365'],
                'template' => '{view}{record}<br>{sync}{export}<br>{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-eye"></i> Просмотр',
                            ['lections/view?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-primary',
                            ]
                        );
                    },
                    'record' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-play"></i> Запись',
                            ['lections/rec?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-success',
                            ]
                        );
                    },
                    'sync' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-cogs" aria-hidden="true"></i> Синхронизация',
                            ['lections/sync?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-default',
                            ]
                        );
                    },
                    'export' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-cloud-download" aria-hidden="true"></i> Экспорт',
                            ['lections/export?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-secondary',
                            ]
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-edit"></i> Обновить',
                            ['lections/edit?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-warning',
                            ]
                        );
                    },
                    'delete' => function ($url,$model, $key) {
                        //ML_TODO: confirm для удаления
                        return Html::a(
                            '<i class="fa fa-remove"></i> Удалить',
                            ['lections/del?id='.$key],
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

    <a href="/admin/lections/new-lection/" class="btn btn-primary btn-lg"><i class="fa fa-bolt"></i> Создать новую лекцию</a>
    <!--Table-->
    <br><br>
</div>
<!--/.Main layout-->
