<?

use app\components\UserHelperClass;
use yii\grid\GridView;
use yii\helpers\Html;

$this->registerJsFile('/modules/admin/web/js/admin_edit.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h1>
                Сообщения    <span class="counter"><?=count($messages)?></span>
            </h1>

        </div>


    </div>
    <?
    if (!empty($messages))
    {
        ?>
        <div class="row">
            <div class="col-md-12">
            <?
            foreach ($messages as $message)
            {
                ?>
                <div class="col-lg-7 col-xl-8">
                    <h3 class="font-weight-bold mb-3">
                        <strong><?= $message['name'] ?></strong>
                    </h3>
                    <p class="dark-grey-text">
                        <?= $message['message'] ?>
                    </p>
                    <p>
                        <a class="font-weight-bold"><?= $message['email'] ?></a>, <?= $message['created_at'] ?>
                        <button data-goto="message-delete=<?=$message['id']?>" type="button" class="btn btn-danger btn-sm">Удалить</button>
                    </p>
                </div>
                <hr>
                <?
            }
            ?>
            </div>
        </div>
        <?
    }
    ?>
</div>


