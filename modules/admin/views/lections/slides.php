<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\DemonstrationsSearch;
use app\models\User;
use yii\helpers\Url;

$this->title = 'Слайды пользователя';
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
    <br>
    <div class="row">
        <div class="col-md-4">
            <a class="btn btn-primary btn-block" href="/admin/lections/new-slide/" role="button">
                <i class="fa fa-plus" aria-hidden="true"></i> Создать новый слайд
            </a>
        </div>
        <div class="col-md-8">
            <div class="demo-block card card-body"></div>
        </div>
        <br>
        <br>
        <br>
        <div class="col-md-12">
           <!-- ML_TODO: таблица с демострациями --->
            <div class="demo-list-wrap">
                <h2>Демонстрационные объекты</h2>
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
                        'name:ntext',
                        'type:ntext',
                        'autor:ntext',
                        'user_id:ntext',
                        'is_active:ntext',
                        'is_visible:ntext',
                        [
                            'label' => 'ICON',
                            'format' => 'raw',
                            'value' => function($data){
                                return Html::img( Url::to($data->icon_src, true),[
                                    'alt'=>'icon_src',
                                    'style' => 'width:85px;'
                                ]);
                            },
                        ],
                        // 'created_at',
                        // 'updated_at',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header'=>'Действия',
                            'headerOptions' => ['width' => '225'],
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a(
                                        '<i class="fa fa-edit"></i>',
                                        ['lections/edit-slide?id='.$key],
                                        [
                                            'class' => 'btn btn-sm btn-primary',
                                        ]
                                    );
                                },
                                'delete' => function ($url,$model, $key) {
                                    //ML_TODO: confirm для удаления
                                    return Html::a(
                                        '<i class="fa fa-remove"></i>',
                                        ['lections/slide-delele?id='.$key],
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

    </div>

    <br><br>
</div>
<!--/.Main layout-->
