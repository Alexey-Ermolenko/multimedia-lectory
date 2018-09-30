<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TestModel */

$this->title = 'Create Test Model';
$this->params['breadcrumbs'][] = ['label' => 'Test Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
