<?php
use yii\helpers\Html;
use app\assets\AppAsset;

use  yii\helpers\Url;

AppAsset::register($this);

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script type='text/javascript' src='https://mdbootstrap.com/wp-content/themes/mdbootstrap4/js/compiled.min.js?ver=4.5.4'></script>

    <link rel="shortcut icon" href="/midoriglobeicon.ico"/>
</head>
<body>
<?php $this->beginBody() ?>
<!--Main Navigation-->
<header>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar navbar-dark green">
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="/">Мультимедиа-лекторий</a>
            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link waves-effect waves-light" href="/">Главная
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="/lections">Лекции</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="/site/about">О сайте</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="/site/contact">Контакты</a>
                    </li>
                </ul>
                <!-- Links -->

                <!-- Search form -->
                <form action="/site/search" class="form-inline">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success btn-sm my-0" type="submit">Поиск</button>
                </form>

                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <?
                    if (Yii::$app->user->isGuest)
                    {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-unique" aria-labelledby="navbarDropdownMenuLink-4" style="position: absolute;">
                                <a class="dropdown-item waves-effect waves-light" href="/site/signup">Регистрация</a>
                                <a class="dropdown-item waves-effect waves-light" href="/site/login">Войти</a>
                            </div>
                        </li>
                        <?
                    } else {
                    ?>
						<li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="/admin/">
							<i class="fa fa-user"></i>
							<?=Yii::$app->user->identity->username?>
							</a>
                        </li>
                        <li class="nav-item avatar dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?
                                if(Yii::$app->user->identity->img_src)
                                {
                                    ?>
                                    <img src="<?= Url::base(true).'/'.Yii::$app->user->identity->img_src ?>" class="img-fluid rounded-circle z-depth-0">
                                    <?
                                }
                                else
                                {
                                    ?>
                                    <img src="web/img/user.png" class="img-fluid rounded-circle z-depth-0">
                                    <?
                                }
                                ?>
							</a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-purple" aria-labelledby="navbarDropdownMenuLink-5">
                                <a class="dropdown-item waves-effect" href="/admin/page/user/">Профиль</a>
                                <a class="dropdown-item waves-effect" href="/site/out">Выход</a>
                            </div>
						</li>
                    <?
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <?=$content?>
</main>
<footer class="page-footer stylish-color-dark">
    <div class="container">
        <div class="row text-center text-md-left mt-3 pb-3">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Мультимедия-лекторий</h6>
                <p>
                    Веб-приложение для создания, редактирования и просмотра мультимедиа лекций
                </p>
            </div>
            <hr class="w-100 clearfix d-md-none">
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Технологии</h6>
                <p><a href="#!">js (jquery)/html5/css3 (bootstrap3)</a></p>
                <p><a href="#!">PHP7/MySql/apache</a></p>
                <p><a href="#!">Yii2</a></p>
                <p><a href="#!">Git</a></p>
            </div>
            <hr class="w-100 clearfix d-md-none">
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Ссылки</h6>
                <p><i class="fa fa-github" aria-hidden="true"></i> <a href="https://github.com/Alexey-Ermolenko/multimedia-lectory">github</a></p>
            </div>
            <hr class="w-100 clearfix d-md-none">
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Контакты</h6>
                <p><i class="fa fa-home mr-3"></i> Новосибирск, РФ</p>
                <p><i class="fa fa-envelope mr-3"></i>a.o.ermolenko@gmail.com</p>
            </div>
        </div>
        <hr>
        <div class="row py-3 d-flex align-items-center">
            <div class="col-md-8 col-lg-9">
                <p class="text-center text-md-left grey-text">
                    © <?= date('Y') ?> Copyright: <a href="https://www.MDBootstrap.com"><strong> MDBootstrap.com</strong></a>
                    <br>
                    <strong><?= Yii::powered() ?></strong>
                </p>
            </div>
        </div>
    </div>
</footer>
<!--
SCRIPTS
    <script type="text/javascript" src="/web/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/web/js/popper.min.js"></script>
    <script type="text/javascript" src="/web/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/web/js/mdb.min.js"></script>
-->
<div class="hiddendiv common"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
