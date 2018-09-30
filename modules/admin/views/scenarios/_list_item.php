<?
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="card border-primary mb-3">
    <div class="card-header">
        <?=$model->name?>
        <a style="float: right" class="btn btn-outline-danger waves-effect btn-sm" href="delete?id=<?=$model->id?>" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</a>
        <a style="float: right" class="btn btn-outline-success waves-effect btn-sm" href="update?id=<?=$model->id?>" role="button"><i class="fa fa-external-link" aria-hidden="true"></i> Редактировать</a>
        <a style="float: right" class="btn btn-primary btn-sm" href="view?id=<?=$model->id?>" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>

    </div>
    <div class="card-body text-secondary">
        <div style="float: left;width: 60%;">
            <h5 class="card-title"><?=$model->autor?></h5>
            <p class="card-text"><?=$model->description?></p>
        </div>
    </div>
    <div class="card-footer">
        <small class="text-muted">Создано:<?=$model->create_date?></small><br>
        <small class="text-muted">Обновлено:<?=$model->update_date?></small>
    </div>
</div>
<br>