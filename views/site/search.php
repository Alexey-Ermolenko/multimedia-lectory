<?

use app\components\UserHelperClass;
use yii\widgets\ListView;

$q = yii\helpers\Html::encode($q);
$this->title = "Результаты поиска по запросу \"$q\"";
?>

<!--Main layout-->
<div class="container-fluid">
    <h1>Результаты поиска «<?=$q?>»</h1>
    </br>
    </br>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_search_item',
        'layout' => "{summary}\n{items}\n{pager}\n",
        'summary' => 'Показано {count} из {totalCount}',
        'summaryOptions' => [
            'tag' => 'span',
            'class' => 'my-summary'
        ],
        'emptyText' => 'Список пуст',
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'nextPageLabel' => 'next',
            'prevPageLabel' => 'previous',
            'maxButtonCount' => 3,
        ],
    ]); ?>
    </br>
    </br>
    </br>
    </br>
    </br>
</div>