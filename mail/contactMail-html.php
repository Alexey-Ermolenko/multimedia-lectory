<?php

/** @var $this \yii\web\View */
/** @var $link string */
/** @var params string */
?>
<p>Вам было отправленно сообщение с сайта <a href="<?=$params['site_url']?>">Мультимедиа-лекторий</a></p>
<p>
    <b><?=$params['date']?></b><br>
    <b> Имя:</b> <?=$params['Contact']['name']?><br>
    <b>E-mail:</b><?=$params['Contact']['email']?><br>
</p>
<p>
    Сообщение<br>
    <?=$params['Contact']['message']?>
</p>
<p>Сообщение отправленно автоматически</p>

