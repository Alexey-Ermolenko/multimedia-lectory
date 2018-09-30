<?
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\LectionsSearch;
use app\models\User;
use yii\helpers\Url;

use yii\helpers\ArrayHelper;
$this->title = 'Лекции пользователя';

$arLection = ArrayHelper::toArray($model);
$arScenarios = ArrayHelper::toArray($scenarioDataProvider->getModels());
# Yii::$app->userHelperClass->pre($arLection);
# Yii::$app->userHelperClass->pre($arScenarios);
?>
<script>
$(document).ready(function() {
    $('#scenarion_list').material_select();
    $('#scenarion_list').change(function() {
         //console.log($('#scenarion_list').val());
         $('#recVideoBtn').attr('data-id_scen', $('#scenarion_list').val());
         $('#recNoVideoBtn').attr('data-id_scen', $('#scenarion_list').val());
        $.ajax({
            url: '/admin/lections/rec/',
            type: "GET",
            dataType: "json",
            data: "id=" + $('#scenarion_list').val(),
            success: function (data) {
                $('.demo-list-view').show();
                $('.js__options_list').show();
                $('.card-body').html("");
                data.forEach(function(item, i, arr) {
                    //console.log( i + ": " + item.icon_src);
                    $('.card-body').append('<img src="'+item.icon_src+'" height="100px" width="100px"/>');
                });

            }
        });
    });

    $('#recVideoBtn').click(function(){
        var id_lection = $(this).attr('data-id_lect');
        var id_scenario = $(this).attr('data-id_scen');
        window.location = '/admin/lections/rec-video?id='+id_lection+'&idscn='+id_scenario;
    });

    $('#recNoVideoBtn').click(function(){
        var id_lection = $(this).attr('data-id_lect');
        var id_scenario = $(this).attr('data-id_scen');
        window.location = '/admin/lections/rec-novideo?id='+id_lection+'&idscn='+id_scenario;

    });
});
</script>
<!--Main layout-->
<div class="container-fluid">
    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий </h1>
        </div>
    </div>
    <!--/.Page heading-->
    <hr>
    <ul class="nav nav-tabs tabs-light-green darken-1" role="tablist">
        <li class="nav-item">
            <a class="nav-link waves-light active" href="/admin/lections/index/">Лекции</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/lections/slides/">Слайды</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/scenarios/" role="tab">Сценарии</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-light" href="/admin/video/" role="tab">Видео</a>
        </li>
    </ul>
    <br><br>
    <?
    if(!empty($arScenarios))
    {
        ?>
        <p>Выберите сценарий для лекции:</p>
        <select id="scenarion_list" class="mdb-select colorful-select dropdown-success">
            <option disabled selected value="" data-id="" data-demo_ids=''>Выберите сценарий</option>
            <?
            foreach ($arScenarios as $n => $arItem)
            {
                ?>
                <option value="<?=$arItem['id']?>" data-id="<?=$arItem['id']?>" data-demo_ids='<?=$arItem['demo_list_json']?>'><?=$arItem['name']?></option>
                <?
            }
            ?>
        </select>
        <label>Список сценариев</label>
        <?
    }
    ?>
    <div class="btn-group btn-group-sm js__options_list" role="group" aria-label="options" style="display: none;">

        <button data-id_lect="<?=$model['id']?>" data-id_scen="" id="recNoVideoBtn" type="button" class="btn btn-primary btn-sm">Начать запись лекции и видео</button>
        <button data-id_lect="<?=$model['id']?>" data-id_scen="" id="recVideoBtn" type="button" class="btn btn-primary btn-sm">Начать запись лекции с уже готовым видео</button>
        <button  id="rec2DispBtn" type="button" class="btn btn-primary btn-sm">Начать запись лекции и видео на два экрана (В ходе разработки)</button>
    </div>
    <hr>

    <div class="demo-list-view" style="display: none;">
        <p>Слайды сценария:</p>
        <div class="card">
            <div class="card-body"></div>
        </div>
    </div>
    <br>
    <br>
</div>
<!--/.Main layout-->
