<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scenarios */

$this->title = 'Create Scenarios';
$this->params['breadcrumbs'][] = ['label' => 'Scenarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scenarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
