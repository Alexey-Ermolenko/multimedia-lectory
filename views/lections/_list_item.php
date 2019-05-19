<?

use yii\helpers\Url;

?>
<div class="row video_item">
    <div class="col-lg-4 mb-4">
        <div class="view overlay hm-white-slight z-depth-1-half">
            <?
            if ($model->poster)
            {
                ?>
                <img src="<?= $model->poster ?>" class="lection-img img-fluid" alt="<?= $model->poster?>">
                <?
            }
            else
            {
                ?>
                <img src="<?= Url::toRoute(['site/getimg', 'text' => urlencode($model->name)]) ?>" class="lection-img img-fluid"
                     alt="<?=$model->name?>">
                <?
            }
            ?>
            <a>
                <div class="mask"></div>
            </a>
        </div>
    </div>
    <div class="col-lg-7 ml-xl-4 mb-4">
        <h4 class="mb-3"><strong><?= $model->name ?></strong></h4>
        <p><?= $model->description ?></p>
        <p><a><strong><?= $model->autor ?></strong></a>, <?= $model->update_date ?></p>
        <a class="btn btn-primary btn-sm" href="<?= Url::toRoute(['lections/view', 'id' => $model->id]) ?>">
            Просмотр
        </a>
    </div>
</div>
<hr class="mb-5">