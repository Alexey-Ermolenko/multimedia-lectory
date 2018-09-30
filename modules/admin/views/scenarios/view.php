<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model app\models\Scenarios */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li>\n",'label' => 'Сценарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Breadcrumbs::widget([
    'homeLink' => ['label' => 'Главная', 'url' => '/'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<div class="scenarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'name',
            'autor',
            'description:ntext',
            //'demo_list_json:ntext',
            'create_date',
            'update_date',
        ],
    ]) ?>

</div>
<div class="demo-list-view">
    <div class="card">
        <div class="card-body">
            <?
            foreach ($model->demo_list_json as $n => $arItem)
            {
                ?>
                <img data-demo_id="<?=$arItem->id?>" src="<?=$arItem->icon_src?>" height="100px" width="100px"/>
                <?
            }
            ?>
        </div>
    </div>
</div>
