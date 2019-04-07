<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="news-item">
    <h2><?=Html::a(Html::encode($model->name), ['/lections/view', 'id' => $model->id]); ?></h2>
    <?= HtmlPurifier::process($model->description) ?><br>
    <small>Дата создания: <?= HtmlPurifier::process($model->created_date) ?></small><br>
    <small>Дата обновления: <?= HtmlPurifier::process($model->update_date) ?></small>
</div>
<br>