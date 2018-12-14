<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ScenariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="contact-section my-5">
    <div class="card">
        <div class="row">
            <div class="col-lg-8">
                <form id="w0" action="/admin/scenarios/index" method="get">
                    <div class="card-body form">
                        <p class="h5-responsive mt-4">
                            <i class="fa fa-search pr-2" aria-hidden="true"></i>
                            Поиск сценария
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0 form-sm">
                                    <input name="ScenariosSearch[name]" type="text" id="form-contact-name" class="form-control">
                                    <label for="form-contact-name" class="">Имя</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0 form-sm">
                                    <input name="ScenariosSearch[autor]" type="text" id="form-contact-email" class="form-control">
                                    <label for="form-contact-email" class="">Автор</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0 form-sm">
                                    <textarea name="ScenariosSearch[description]" type="text" id="form-contact-message" class="form-control md-textarea" rows="3"></textarea>
                                    <label for="form-contact-message">Описание</label>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Search</button>
                                    <button type="reset" class="btn btn-default waves-effect waves-light">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>