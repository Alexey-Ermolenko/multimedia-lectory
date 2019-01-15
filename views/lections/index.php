<?
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\LectionsSearch;
use yii\widgets\ListView;
$this->title = 'Мультимедиа-лекторий | Лекции';
?>

<div class="container-fluid">
    <br>
    <div class="lections row">
        <div class="col-md-9">
            <div class="row">
                <section class="section extra-margins pb-3 text-center text-lg-left">
                    <div class="section_heading_block">
                        <h2 class="h2">Лекции
                            <?
                            if(!empty($category))
                            {
                                ?>
                                <small class="text-muted">
                                    <?=$category['name']?>
                                </small>
                                <?
                            }
                            ?>

                        </h2>
                        <?
                        if ($category['description'])
                        {
                            ?>
                            <p>
                               <?=$category['description']?>
                            </p>
                            <?
                        }
                        ?>
                    </div>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => '_list_item',
                        'layout' => "{summary}\n{items}",
                        'summary' => '{count} из {totalCount}',
                        'summaryOptions' => [
                            'tag' => 'span',
                            'class' => 'my-summary'
                        ],
                        'emptyText' => 'Список пуст',
                    ]);

                    echo \yii\widgets\LinkPager::widget([
                        'pagination'=>$dataProvider->pagination,
                    ]);
                    ?>
                    <!--
                    <nav class="pagination_lections row flex-center wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link waves-effect waves-effect" href="#!" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link waves-effect waves-effect" href="#!">1 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link waves-effect waves-effect" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link waves-effect waves-effect" href="#!">3</a></li>
                            <li class="page-item"><a class="page-link waves-effect waves-effect" href="#!">4</a></li>
                            <li class="page-item"><a class="page-link waves-effect waves-effect" href="#!">5</a></li>
                            <li class="page-item">
                                <a class="page-link waves-effect waves-effect" href="#!" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    -->
                </section>
            </div>
        </div>
        <div class="col-md-3">
            <?
                if(!empty($categories))
                {
                    ?>
                        <section class="section mb-5">
                        <div class="card card-body pb-0">
                            <div class="single-post">
                                <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                    <strong>Категории</strong>
                                </p>
                                <ul class="list-group my-4">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a class="" href="/lections/index?LectionsSearch[category_id]=">
                                            <p class="mb-0">Все разделы</p>
                                        </a>
                                        <span class="badge teal badge-pill font-small"></span>
                                    </li>
                                    <?
                                    foreach ($categories as $category)
                                    {
                                        //Url::current(['cat' => $category['id']])
                                        ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="" href="/lections/index?LectionsSearch[category_id]=<?=$category['id']?>">
                                                <p class="mb-0"><?=$category['name']?></p>
                                            </a>
                                            <span class="badge teal badge-pill font-small"><?=$category['count']?></span>
                                        </li>
                                        <?
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <?
                }
                if(!empty($popular_lections))
                {
                    ?>
                        <section class="section widget-content mt-5">
                        <div class="card card-body pb-0">
                            <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                <strong>Популярные лекции</strong>
                            </p>
                            <?
                            foreach ($popular_lections as $lectionItem)
                            {
                                if($lectionItem['view_count'] > 0)
                                {
                                    ?>
                                    <div class="single-post">
                                        <div class="row mb-4">
                                            <div class="view overlay"><a><div class="mask rgba-white-slight waves-effect waves-light"></div></a></div>
                                            <div class="col-12">
                                                <a href="<?=Url::toRoute(['lections/view', 'id' => $lectionItem['id']])?>"><?=$lectionItem['name']?> <span class="badge teal badge-pill font-small"><?=$lectionItem['view_count']?></span></a>
                                                <div class="post-data">
                                                    <p class="font-small grey-text mb-0">
                                                        <i class="fa fa-clock-o"></i> <?=$lectionItem['created_date']?>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }
                            }
                            ?>
                        </div>
                    </section>
                    <?
                }
                if(!empty($dates))
                {
                    ?>
                        <section class="archive mb-5">
                        <div class="card card-body pb-0">
                            <div class="single-post">
                                <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                    <strong>Архив</strong>
                                </p>
                                <div class="row mb-4">
                                    <div class="col-md-12 text-center">
                                        <ul class="list-unstyled">
                                            <?
                                            foreach ($dates as $dateItem)
                                            {
                                                ?>
                                                <li>
                                                    <p class="mb-1 mt-2">
                                                        <a href="/lections/index?LectionsSearch[created_date]=<?=$dateItem['created_date']?>" class="dark-grey-text"><?=$dateItem['created_date']?></a>
                                                    </p>
                                                </li>
                                                <?
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?
                }
            ?>
        </div>
    </div>
</div>
