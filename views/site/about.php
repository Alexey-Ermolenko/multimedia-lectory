<?php

/* @var $this yii\web\View */
/*
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
*/
$this->title = 'О нас';
?>
<!--Main layout-->
<div class="container">
    <div id="carousel-example-3" class="carousel slide carousel-fade white-text" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-3" data-slide-to="0" class=""></li>
            <li data-target="#carousel-example-3" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-3" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item view hm-black-light" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(11).jpg'); background-repeat: no-repeat; background-size: cover;">
                <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeIn col-md-12">
                        <li>
                            <h1 class="h1-responsive">Мультимедиа-лекторий</h1>
                        </li>
                        <li>
                            <p>Веб-приложение для создания, редактирования и просмотра мультимедиа лекций</p>
                        </li>
                        <li>
                            <a target="_blank" href="https://mdbootstrap.com/getting-started/" class="btn btn-info btn-lg waves-effect waves-light" rel="nofollow">See more!</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="carousel-item view hm-black-light" style="background-image: url('https://mdbootstrap.com/img/Photos/Slides/img%20(67).jpg'); background-repeat: no-repeat; background-size: cover;">
                <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeIn col-md-12">
                        <li>
                            <h1 class="h1-responsive">Не просто онлайн-видео</h1>
                        </li>
                        <li>
                            <p>
                                Система создания онлайн видео-лекций, с демонстрационными материалами
                            </p>
                        </li>
                        <li>
                            <a target="_blank" href="https://mdbootstrap.com/bootstrap-tutorial/" class="btn btn-info btn-lg waves-effect waves-light" rel="nofollow">Read more</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="carousel-item view hm-black-light active" style="background-image: url('https://mdbootstrap.com/img/Photos/Slides/img%20(97).jpg'); background-repeat: no-repeat; background-size: cover;">
                <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeIn col-md-12">
                        <li>
                            <h1 class="h1-responsive">Weekend in the nature - the best way to relax</h1>
                        </li>
                        <li>
                            <p>8 Reasons why you need to spend more time in nature</p>
                        </li>
                        <li>
                            <a target="_blank" href="https://mdbootstrap.com/forums/forum/support/" class="btn btn-default btn-lg waves-effect waves-light" rel="nofollow">Read more</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-example-3" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-3" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="divider-new pt-5">
        <h2 class="h2-responsive wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
            О нас
        </h2>
    </div>
    <section id="about" class="text-center wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
        <p>
            Мультимедиа-лекторий - система онлайн образования
        </p>
    </section>
    <div class="divider-new pt-5">
        <h2 class="h2-responsive wow fadeIn" style="animation-name: none; visibility: visible;">
            Инновации
        </h2>
    </div>
    <section id="best-features">
        <div class="row pt-3">
            <div class="col-lg-3 mb-r">
                <div class="card wow fadeIn" style="animation-name: none; visibility: visible;">
                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(25).jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            Круглосуточно 24/7
                        </h4>
                        <hr>
                        <p class="card-text">
                            Вам не придется ждать утра понедельника чтобы начать.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-r">
                <div class="card wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(14).jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            Абсолютно бесплатно
                        </h4>
                        <hr>
                        <p class="card-text">
                            Тут не нужно платить, но если хотите, то платите.<br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-r">
                <div class="card wow fadeIn" data-wow-delay="0.4s" style="animation-name: none; visibility: visible;">
                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(21).jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            Отборный супер контент
                        </h4>
                        <hr>
                        <p class="card-text">
                            Отборный контент, заправит вас необходимыми знаниями.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-r">
                <div class="card wow fadeIn" data-wow-delay="0.6s" style="animation-name: none; visibility: visible;">
                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(37).jpg" alt="Card image cap">
                    <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title text-center">
                            Делитесь образованием
                        </h4>
                        <hr>
                        <p class="card-text">
                            Вы можете создавать свои мультимедиа-лекции.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="divider-new">
        <h2 class="h2-responsive wow fadeIn" style="animation-name: none; visibility: visible;">
            Свяжитесь с нами
        </h2>
    </div>
    <section id="contact pb-5">
        <div class="row">
            <div class="col-md-8 mb-5">
                <div id="map-container" class="z-depth-1 wow fadeIn" style="height: 300px; animation-name: none; visibility: visible; position: relative; overflow: hidden;">
                    <iframe src="https://maps.google.com/maps?q=Novosibirsk&t=&z=10&ie=UTF8&iwloc=&output=embed"
                            frameborder="0"
                            style="border:0; height: 100%; width: 100%" allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="text-center list-unstyled">
                    <li class="wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
                        <i class="fa fa-map-marker teal-text fa-lg"></i>
                        <p>Новосибирск, НСК 630011, РФ</p>
                    </li>

                    <li class="wow fadeIn mt-5 pt-2" data-wow-delay="0.3s"
                        style="animation-name: none; visibility: visible;">
                        <i class="fa fa-phone teal-text fa-lg"></i>
                        <p>+ 01 234 567 89</p>
                    </li>

                    <li class="wow fadeIn mt-5 pt-2" data-wow-delay="0.4s"
                        style="animation-name: none; visibility: visible;">
                        <i class="fa fa-envelope teal-text fa-lg"></i>
                        <p>a.o.ermolenko@gmail.com</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <hr>
    <div class="card">
        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Свяжитесь с нами</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <form class="md-form" style="color: #757575;">
                <input type="text" id="materialContactFormName" class="form-control" placeholder="Ваше имя">
                <label for="materialContactFormName"></label>
                <input type="email" id="materialContactFormEmail" class="form-control" placeholder="Ваше e-mail">
                <label for="materialContactFormEmail"></label>
                <div>
                    <select class="mdb-select" id="materialSelect">
                        <option value="" disabled selected>Feedback</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                    <label for="materialSelect"></label>
                </div>
                <textarea type="text" id="materialContactFormMessage" class="form-control md-textarea" rows="3" placeholder="Сообщение"></textarea>
                <label for="materialContactFormMessage"></label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="materialContactFormCopy">
                    <label class="form-check-label" for="materialContactFormCopy">
                        Отправить мне копию сообщения
                    </label>
                </div>
                <br>
                <div class="form-check">
                    <p>
                        Отправляя сообщение вы соглашаетесь с условиями обработки данных
                    </p>
                </div>
                <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">
                    Отправить
                </button>
            </form>
        </div>
    </div>
</div>
