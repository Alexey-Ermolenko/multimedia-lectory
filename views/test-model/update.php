<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestModel */

$this->title = 'Update Test Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Test Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
