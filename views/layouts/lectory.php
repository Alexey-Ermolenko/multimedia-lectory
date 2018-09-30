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
								<img src="<?= Url::base(true).'/'.Yii::$app->user->identity->img_src ?>" class="img-fluid rounded-circle z-depth-0">
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

				<!--
				<ul class="navbar-nav ml-auto nav-flex-icons">
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light">1 <i class="fa fa-envelope"></i></a>
                        </li>
                        <li class="nav-item avatar dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="img-fluid rounded-circle z-depth-0">
							</a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-purple" aria-labelledby="navbarDropdownMenuLink-5">
                                <a class="dropdown-item waves-effect waves-light" href="#">Action</a>
                                <a class="dropdown-item waves-effect waves-light" href="#">Another action</a>
                                <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a>
                            </div>
                        </li>
                </ul>
				-->

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
<footer class="page-footer stylish-color-dark">

    <!--Footer Links-->
    <div class="container">

        <!-- Footer links -->
        <div class="row text-center text-md-left mt-3 pb-3">

            <!--First column-->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Company name</h6>
                <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <!--/.First column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Second column-->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Products</h6>
                <p><a href="#!">MDBootstrap</a></p>
                <p><a href="#!">MDWordPress</a></p>
                <p><a href="#!">BrandFlow</a></p>
                <p><a href="#!">Bootstrap Angular</a></p>
            </div>
            <!--/.Second column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Third column-->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Useful links</h6>
                <p><a href="#!">Your Account</a></p>
                <p><a href="#!">Become an Affiliate</a></p>
                <p><a href="#!">Shipping Rates</a></p>
                <p><a href="#!">Help</a></p>
            </div>
            <!--/.Third column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Fourth column-->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Contact</h6>
                <p><i class="fa fa-home mr-3"></i> New York, NY 10012, US</p>
                <p><i class="fa fa-envelope mr-3"></i> info@example.com</p>
                <p><i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
                <p><i class="fa fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!--/.Fourth column-->

        </div>
        <!-- Footer links -->

        <hr>

        <div class="row py-3 d-flex align-items-center">

            <!--Grid column-->
            <div class="col-md-8 col-lg-9">

                <!--Copyright-->
                <p class="text-center text-md-left grey-text">© 2017 Copyright: <a href="https://www.MDBootstrap.com"><strong> MDBootstrap.com</strong></a></p>
                <!--/.Copyright-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 col-lg-3 ml-lg-0">

                <!--Social buttons-->
                <div class="social-section text-center text-md-left">
                    <ul>
                        <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-google-plus"></i></a></li>
                        <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <!--/.Social buttons-->

            </div>
            <!--Grid column-->

        </div>

    </div>

</footer>
<!--/.Footer-->


<script type="text/javascript" src="/web/js/bootstrap.min.js"></script>

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
