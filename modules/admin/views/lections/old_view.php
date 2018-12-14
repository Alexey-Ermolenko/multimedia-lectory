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
    <?
    /*
    Yii::$app->userHelperClass->pre($searchModel);
    Yii::$app->userHelperClass->pre($dataProvider);
    */
    ?>
    <div class="btn-group">
        <a href="/admin/lections/index"  role="button" class="btn btn-default">Лекции</a>
        <a href="/admin/lections/slides"  role="button" class="btn btn-outline-default waves-effect">Слайды</a>
        <a href="#3"  role="button" class="btn btn-outline-default waves-effect">Сценарии</a>
        <a href="#4"  role="button" class="btn btn-outline-default waves-effect">Запись лекций</a>
        <a href="#5"  role="button" class="btn btn-outline-default waves-effect">Добавление видео</a>
        <a href="#6"  role="button" class="btn btn-outline-default waves-effect">Синхронизация лекции</a>
        <a href="#7"  role="button" class="btn btn-outline-default waves-effect">Экспорт лекции</a>
    </div>
    <br><br><br>
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
            'description:ntext',
            'keywords:ntext',
            'content:ntext',
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
                        'style' => 'width:15px;'
                    ]);
                },
            ],
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '225'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-eye"></i>',
                            ['lections/view?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-primary',
                            ]
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-edit"></i>',
                            ['lections/edit?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-primary',
                            ]
                        );
                    },
                    'delete' => function ($url,$model, $key) {
                        //ML_TODO: confirm для удаления
                        return Html::a(
                            '<i class="fa fa-remove"></i>',
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

    <a class="btn btn-primary btn-lg"><i class="fa fa-bolt"></i> Создать новую лекцию</a>
    <!--Table-->
    <br><br>
</div>
<!--/.Main layout-->
