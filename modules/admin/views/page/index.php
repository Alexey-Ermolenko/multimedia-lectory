<?
$this->registerJsFile('/modules/admin/web/js/admin.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="container-fluid">

    <!--Page heading-->
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-responsive">Мультимедиа-лекторий </h1>
        </div>
    </div>
    <!--/.Page heading-->
    <hr>


    <div class="col-md-12">
        <div class="stepwizard">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    <a href="#1" role="button" class="btn btn-default btn-circle">1</a>
                    <p>Создание<br>лекции</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#1" role="button" class="btn btn-primary btn-circle">2</a>
                    <p>Создание <br>и выбор слайдов</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#3" role="button" class="btn btn-default btn-circle">3</a>
                    <p>Создание <br>сценария</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#4" role="button" class="btn btn-default btn-circle">4</a>
                    <p>Запись <br>лекции</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#5" role="button" class="btn btn-default btn-circle">5</a>
                    <p>Добавление <br>видео файла</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#6" role="button" class="btn btn-default btn-circle">6</a>
                    <p>Синхронизация <br>лекции</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#7" role="button" class="btn btn-default btn-circle">7</a>
                    <p>Экспорт <br>лекции</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="card mdb-color lighten-2 text-center z-depth-2">
            <div class="card-body">
                <p class="white-text mb-0">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                    erat a ante.</p>
            </div>
        </div>

        <br>

        <div class="jumbotron">
            <h1 class="h1-responsive">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention
                to featured content or information.</p>
            <hr class="my-2">
            <p>It uses utility classes for typography and spacing to space content out within the larger
                container.
            </p>
            <a href="lections.html" class="btn btn-primary btn-lg" role="button">Мои лекции</a>
        </div>
        <br>

        <p class="text-justify">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>

        <div class="card indigo text-center z-depth-2">
            <div class="card-body">
                <p class="white-text mb-0">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                    erat a ante.</p>
            </div>
        </div>

    </div>

</div>