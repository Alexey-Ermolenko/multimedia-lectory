<?
$this->registerJsFile('/modules/admin/web/js/admin_edit.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\UserSearch;
use app\models\User;
use yii\helpers\Url;

?>
<div class="container-fluid">
    <h1>Список пользователей</h1>
    <?
    if (Yii::$app->user->identity->role == \app\models\User::ROLE_ADMIN)
    {
        echo '<h2>Администратор</h2>';
    } else {
        echo '<h2>Пользователь</h2>';
    }
	//ML_TODO: таблица с пользователями

	//Yii::$app->userHelperClass->pre(Yii::$app->user);
    ?>
    <p>Список пользователей для редактирования администратором</p>
    <!--
    <div class="btn-group">
        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Small button
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
        </div>
    </div>

    -->

    <?= yii\widgets\LinkSorter::widget([
        'sort' => $provider->sort,
        'attributes' => [
            'id',
            'role',
            'status',
            'username',
            'email',
            'created_at',
        ]
    ]);?>
    <?= GridView::widget([
        'tableOptions'=> [
            'class' => 'table table-sm table-striped table-bordered table-hover'
        ],
        'showHeader' => true,
        'showOnEmpty'=>true,
        'layout'=>"{summary}\n{items}\n",
        'dataProvider' => $provider,
        'filterModel' => new UserSearch(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'ID',
                'attribute' => 'id',
            ],
            [
                'header' => 'Имя пользователя',
                'attribute' => 'username',
            ],
            [
                'header' => 'Email',
                'attribute' => 'email',
            ],
            [
                'header' => 'Роль',
                'attribute' => 'role',
                /*'filter'=>array("20"=>"Админ","10"=>"Не админ"),*/
            ],
            [
                'header' => 'Статус',
                'attribute' => 'status',

            ],
            [
                'header' => 'Дата создания',
                'attribute' => 'created_at',
                'format' =>  ['Date', 'HH:mm:ss dd.MM.Y'],

            ],
            [
                'header' => 'Фото',
                'attribute' => 'img_src',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::img(
                        Url::to($data->img_src, true),
                        [
                        'alt'=>'-',
                        'style' => 'width:80px;'
                        ]
                    );
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '265'],
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fa fa-edit"></i> Редактировать',
                            ['page/admin-user-edit?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-primary',
                            ]
                        );
                    },
                    'delete' => function ($url,$model, $key) {
                        //ML_TODO: confirm для удаления пользователя
                        return Html::a(
                            '<i class="fa fa-remove"></i> Удалить',
                            ['page/admin-user-del?id='.$key],
                            [
                                'class' => 'btn btn-sm btn-danger',
                                'onclick'=>'confirm("Удалить пользователя ?");'
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
    <br><br><br>
    <nav>
        <?= \yii\widgets\LinkPager::widget([
                'pagination'=>$provider->pagination,
                'options' => [
                    'class' => 'pagination pg-darkgrey',
                    'pageCssClass' => 'page-item',
                    'nextPageCssClass' => 'page-item',
                    'nextPageCssClass' => 'page-item',

                    'firstPageCssClass' => 'page-item active',
                    'maxButtonCount' => 10,
                ]
            ]);
        ?>
    </nav>
</div>