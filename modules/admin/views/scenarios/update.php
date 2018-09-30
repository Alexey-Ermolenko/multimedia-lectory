<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\DemonstrationsSearch;
use app\models\User;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Scenarios */

$this->title = 'Обновить сценарий: ' . $model->name;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['template' => "<li>{link}</li> \n",'label' => 'Сценарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$array_demos = json_decode($model->demo_list_json, true);
?>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => 'Главная', 'url' => '/'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<div class="container-fluid">
    <div class="row">
        <!-- Grid column -->
        <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="data[user_id]" value="<?=Yii::$app->user->identity->getId()?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Название сценария</label>
                        <input name="data[name]" type="text" class="form-control" id="inputEmail4" value="<?=$model->name?>" placeholder="Название сценария">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Автор</label>
                        <input name="data[autor]" type="text" class="form-control" id="inputPassword4" value="<?=$model->autor?>" placeholder="Автор">
                    </div>
                </div>
                <div class="form-group">
                    <div class="md-form">
                        <textarea name="data[description]" type="text" id="text2" value="<?=$model->description?>" placeholder="Описание сценария" class="md-textarea md-textarea-auto form-control" rows="2"><?=$model->description?></textarea>
                        <label for="text2">Описание сценария</label>
                    </div>
                </div>
                <?
               # Yii::$app->userHelperClass->pre($array_demos);
               # Yii::$app->userHelperClass->pre($userDemoDataProvider);
                ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        Мои демонстрации:<br>
                        <div class="scenario_demo-block">
                            <?
                            Yii::$app->userHelperClass->pre($userDemoDataProvider->getCount());
                            Yii::$app->userHelperClass->pre($userDemoDataProvider->getTotalCount());
                            # Yii::$app->userHelperClass->pre($userDemoDataProvider->getModels());
                            ?>
                            <!--Table-->
                            <table id="tablePreview" class="table">
                                <!--Table head-->
                                <thead class="black white-text">
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Автор</th>
                                    <th>Тип демонстрации</th>
                                    <th>image</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <!--Table head-->
                                <!--Table body-->
                                <tbody>
                                <?
                                foreach ($userDemoDataProvider->getModels() as $n => $arItem)
                                {
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$n+1?></th>
                                        <td><?=$arItem['name']?></td>
                                        <td><?=$arItem['autor']?></td>
                                        <td><?=$arItem['type']?></td>
                                        <td>
                                            <img src="<?=$arItem['icon_src']?>" width="100px"/>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input name="data[demos][]" value="<?=$arItem['id']?>" <?=(in_array($arItem['id'], $array_demos) ? 'checked':'')?> type="checkbox" class="form-check-input" id="check-<?=$arItem['id']?>">
                                                <label class="form-check-label" for="check-<?=$arItem['id']?>">Выбрать</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?
                                }
                                ?>
                                </tbody>
                                <!--Table body-->
                            </table>
                            <!--Table-->

                            <?=/* GridView::widget([
                                'dataProvider' => $userDemoDataProvider,
                                //'filterModel' => $searchUserDemo,
                                'tableOptions' => [
                                    'class' => 'table table-sm table-striped table-bordered table-hover'
                                ],
                                'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",

                                'showHeader'=>false,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'name:ntext',
                                    'type:ntext',
                                    'autor:ntext',
                                    [
                                        'headerOptions' => ['width' => '350'],
                                        'label' => 'ICON',
                                        'format' => 'raw',
                                        'value' => function($data){
                                            return Html::img( Url::to($data['icon_src'], true),[
                                                'alt'=>'icon_src',
                                                'style' => 'width:100px;'
                                            ]);
                                        },
                                    ],
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<div class="form-check">
                                              <input name="data[demos][]" value="'.$data['id'].'" '.(in_array($data['id'], [2,3]) ? 'checked':'').' type="checkbox" class="form-check-input" id="check-'.$data['id'].'">
                                              <label class="form-check-label" for="check-'.$data['id'].'">Выбрать</label>
                                            </div>';
                                        }
                                    ],
                                ],
                            ]); */ ''?>
                        </div>
                        <br>
                        Общие демонстрации:<br>
                        <div class="scenario_demo-block">
                            <?
                            Yii::$app->userHelperClass->pre($allDemosDataProvider->getCount());
                            Yii::$app->userHelperClass->pre($allDemosDataProvider->getTotalCount());
                            # Yii::$app->userHelperClass->pre($userDemoDataProvider->getModels());
                            ?>
                            <!--Table-->
                            <table id="tablePreview" class="table">
                                <!--Table head-->
                                <thead class="black white-text">
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Автор</th>
                                    <th>Тип демонстрации</th>
                                    <th>image</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <!--Table head-->
                                <!--Table body-->
                                <tbody>
                                <?
                                foreach ($allDemosDataProvider->getModels() as $n => $arItem)
                                {
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$n+1?></th>
                                        <td><?=$arItem['name']?></td>
                                        <td><?=$arItem['autor']?></td>
                                        <td><?=$arItem['type']?></td>
                                        <td>
                                            <img src="<?=$arItem['icon_src']?>" width="100px"/>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input name="data[demos][]" value="<?=$arItem['id']?>" <?=(in_array($arItem['id'], $array_demos) ? 'checked':'')?> type="checkbox" class="form-check-input" id="check-<?=$arItem['id']?>">
                                                <label class="form-check-label" for="check-<?=$arItem['id']?>">Выбрать</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?
                                }
                                ?>
                                </tbody>
                                <!--Table body-->
                            </table>
                            <!--Table-->
                            <?=/* GridView::widget([
                                'dataProvider' => $allDemosDataProvider,
                                //'filterModel' => $searchUserDemo,
                                'tableOptions' => [
                                    'class' => 'table table-sm table-striped table-bordered table-hover'
                                ],
                                'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",

                                'showHeader'=>false,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'name:ntext',
                                    'type:ntext',
                                    'autor:ntext',
                                    [
                                        'headerOptions' => ['width' => '350'],
                                        'label' => 'ICON',
                                        'format' => 'raw',
                                        'value' => function($data){
                                            return Html::img( Url::to($data['icon_src'], true),[
                                                'alt'=>'icon_src',
                                                'style' => 'width:100px;'
                                            ]);
                                        },
                                    ],
                                    [
                                        //'class' => 'yii\grid\CheckboxColumn',
                                        'content' => function ($data, $key, $index, $column) {
                                            #var_dump($data);
                                            return '<div class="form-check">
                                              <input name="data[demos][]" value="'.$data['id'].'" type="checkbox" class="form-check-input" id="check-'.$data['id'].'">
                                              <label class="form-check-label" for="check-'.$data['id'].'">Выбрать</label>
                                            </div>';
                                        }
                                    ],
                                ],
                            ]); */ ''?>
                        </div>
                    </div>
                </div>
                <!--
                <div class="form-row">
                    <div class="form-group col-md-12">
                        Мои демонстрации:<br>
                        <div class="slide-list-block card card-body">
                            <div class="thumb icon_list" id="icon_list">
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="1"
                                         alt="1" data-slider_id="1"
                                         src="/repository/user/demonstrations/slide/contents/file_1531650207.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="11"
                                         alt="11" data-slider_id="11"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="2"
                                         alt="2" data-slider_id="2"
                                         src="/repository/user/demonstrations/slide/contents/501492.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="3"
                                         alt="3" data-slider_id="3"
                                         src="/repository/user/demonstrations/slide/contents/639706-1280x1024.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="4"
                                         alt="4"  data-slider_id="4"
                                         src="/repository/user/demonstrations/slide/contents/101287190.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="5"
                                         alt="5" data-slider_id="5"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="6"
                                         alt="6"  data-slider_id="6"
                                         src="/repository/user/demonstrations/slide/contents/1353762564533.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="7"
                                         alt="7" data-slider_id="7"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="8"
                                         alt="8" data-slider_id="8"
                                         src="/repository/user/demonstrations/slide/contents/101287190.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="9"
                                         alt="9" data-slider_id="9"
                                         src="/repository/user/demonstrations/slide/contents/!!!!!!!!!!!.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="10"
                                         alt="10" data-slider_id="10"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                            </div>
                        </div>


                    <br>
                    Общие демонстрации:<br>
                        <div class="slide-list-block card card-body">
                            <div class="thumb icon_list" id="icon_list">
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="1"
                                         alt="1" data-slider_id="1"
                                         src="/repository/user/demonstrations/slide/contents/file_1531650207.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="11"
                                         alt="11" data-slider_id="11"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="2"
                                         alt="2" data-slider_id="2"
                                         src="/repository/user/demonstrations/slide/contents/501492.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="3"
                                         alt="3" data-slider_id="3"
                                         src="/repository/user/demonstrations/slide/contents/639706-1280x1024.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="4"
                                         alt="4"  data-slider_id="4"
                                         src="/repository/user/demonstrations/slide/contents/101287190.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="5"
                                         alt="5" data-slider_id="5"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="6"
                                         alt="6"  data-slider_id="6"
                                         src="/repository/user/demonstrations/slide/contents/1353762564533.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="7"
                                         alt="7" data-slider_id="7"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="8"
                                         alt="8" data-slider_id="8"
                                         src="/repository/user/demonstrations/slide/contents/101287190.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="9"
                                         alt="9" data-slider_id="9"
                                         src="/repository/user/demonstrations/slide/contents/!!!!!!!!!!!.jpg">
                                </div>
                                <div class="demo-icon-item">
                                    <img data-src="" class="img-rounded icon_item" id="10"
                                         alt="10" data-slider_id="10"
                                         src="/repository/user/demonstrations/slide/contents/1347474636802.jpg">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                -->
                <button type="submit" class="btn btn-primary btn-md">Сохранить</button>
                <button type="reset" class="btn btn-danger btn-md">Сбросить</button>
            </form>
        </div>
        <!-- Grid column -->
    </div>
</div>
