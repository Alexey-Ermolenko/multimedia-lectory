<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;
use yii\data\Pagination;

$this->title = 'Мультимедиа-лекторий | Главная';
?>

    <!--Main layout-->
    <div class="container">

        <!--Page heading-->
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1-responsive">Мультимедиа-лекции </h1>
                <h3>
                    <small class="text-muted">Портал веб-лекций с расширенным демонстрационным рядом и возможностью как просмотра онлайн, так и скачивания файлов для воспроизведеня без подключения к интернет. <br/>  Приятного просмотра! </small>
                </h3>
            </div>
        </div>
        <!--/.Page heading-->
        <?
       // Yii::$app->userHelperClass->pre($models);
       // Yii::$app->userHelperClass->pre($pages);
        ?>
        <div class="row mt-5 wow" style="animation-name: none; visibility: visible;">
        <?
        foreach ($models as $n => $model)
        {
            ?>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
                <div class="card">
                    <?
                    if($model->poster)
                    {
                    ?><img class="img-fluid" src="<?=$model->poster?>" alt="Card image cap"><?
                    }
                    ?>
                    <div class="card-body">
                        <h4 class="card-title"><?=$model->name?></h4>
                        <p class="card-text"><?=$model->description?></p>
                        <a href="<?=Url::toRoute(['lections/view', 'id' => $model->id])?>" class="btn btn-primary waves-effect waves-light">Просмотр</a>
                    </div>
                </div>
            </div>
            <?
            if (($n+1 % 3) == 0)
            {
                ?>
        </div>
        <div class="row mt-5 wow" style="animation-name: none; visibility: visible;">
                <?
            }
            /*
                Yii::$app->userHelperClass->pre($model->name);
                Yii::$app->userHelperClass->pre($model->user_id);
                Yii::$app->userHelperClass->pre($model->description);
                Yii::$app->userHelperClass->pre($model->keywords);
                Yii::$app->userHelperClass->pre($model->content);
                Yii::$app->userHelperClass->pre($model->task_group);
                Yii::$app->userHelperClass->pre($model->autor);
                Yii::$app->userHelperClass->pre($model->is_active);
                Yii::$app->userHelperClass->pre($model->created_date);
                Yii::$app->userHelperClass->pre($model->poster);
            */
        }

        while (($i % 3) != 0)
        {
            ?>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
                &nbsp;
            </div>
            <?
            $i++;
        }
        ?>
        </div>
        <hr>
        <?
        // отображаем ссылки на страницы
        //https://github.com/kop/yii2-scroll-pager
        ?>
        <nav class="row flex-center wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
            <?
            echo app\components\MyPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </nav>
    </div>
<!--/.Main layout-->
