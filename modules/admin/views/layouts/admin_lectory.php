<?

use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\AdminAsset;

use  yii\helpers\Url;

AdminAsset::register($this);

//AppAsset::register($this);

$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type='text/javascript' src="/modules/admin/web/js/compiled.min.js"></script>
        <script src="https://www.youtube.com/iframe_api"></script>
        <!---->

        <!--
        SCRIPTS
        <script type="text/javascript" src="/modules/admin/web/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/modules/admin/web/js/popper.min.js"></script>
        <script type="text/javascript" src="/modules/admin/web/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/modules/admin/web/js/mdb.min.js"></script>
        <script type='text/javascript' src="/modules/admin/web/js/compiled.min.js"></script>-->
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!--Main Navigation-->
    <header>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark blue fixed-top scrolling-navbar">
            <div class="container">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="/">Мультимедиа-лекторий</a>
                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link waves-effect waves-light" href="/admin/">Главная
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="/admin/lections/">Лекции</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="/admin/page/user/">Профиль</a>
                        </li>
                    </ul>
                    <form action="/site/search" class="form-inline">
                        <input class="form-control mr-sm-2" type="text" placeholder="Поиск лекций" aria-label="Поиск лекций" name="q">
                        <button class="btn btn-success btn-sm my-0" type="submit">Поиск</button>
                    </form>
                    <ul class="navbar-nav ml-auto nav-flex-icons">
                        <?
                        if (Yii::$app->user->isGuest)
                        {
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-unique" aria-labelledby="navbarDropdownMenuLink" style="position: absolute;">
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
                                    if (Yii::$app->user->identity->img_src)
                                    {
                                        ?>
                                        <img src="<?= Url::base(true).'/'.Yii::$app->user->identity->img_src ?>" class="img-fluid rounded-circle z-depth-0">
                                        <?
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="/modules/admin/web/img/user.png" class="img-fluid rounded-circle z-depth-0">
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
                <!-- Collapsible content -->
            </div>
        </nav>
        <!--/.Navbar-->

    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main>
        <?=$content?>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer blue center-on-small-only">

        <!--Footer Links-->
        <div class="container">
            <div class="row">
                <!--First column-->
                <div class="col-md-6">
                    <h5 class="title">Панель администратора</h5>
                    <p>Тут можно создавать и редактировать мультимедиа-лекции</p>
                </div>
                <!--/.First column-->

                <!--Second column-->
                <div class="col-md-6">
                    <h5 class="title">Ссылки</h5>
                    <ul>
                        <li><a href="/">Мультимедиа-лекторий</a></li>
                        <li><a href="/admin/">Главная</a></li>
                        <li><a href="/admin/page/user/">Профиль</a></li>
                        <li><a href="/admin/lections/">Лекции</a></li>
                    </ul>
                </div>
                <!--/.Second column-->
            </div>
        </div>
        <!--/.Footer Links-->

        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
                © <?= date('Y') ?> Copyright: <a href="https://www.MDBootstrap.com"> MDBootstrap.com </a>
            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->
    <div class="hiddendiv common"></div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>