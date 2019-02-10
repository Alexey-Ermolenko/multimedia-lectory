<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><?= Html::encode($this->title) ?></h1>
                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
                <p>Вышеуказанная ошибка произошла, когда веб-сервер обрабатывал ваш запрос.
                Пожалуйста, свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.</p>
                <center>
                    <img src="/web/img/error.jpg" alt="thumbnail" class="img-fluid" style="width: 500px">
                    <br>
                    <?= Html::a("Перейти на главную", ['/']); ?>
                </center>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
