<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Scenarios */

$this->title = 'Обновить сценарий: ' . $model->name;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li>\n",'label' => 'Сценарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => 'Главная', 'url' => '/'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<div class="scenarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="scenarios-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'autor')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>



        <?= $form->field($model, 'create_date')->textInput() ?>

        <?= $form->field($model, 'update_date')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
