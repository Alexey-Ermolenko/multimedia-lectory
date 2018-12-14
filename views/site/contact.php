<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
/*
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
*/

$this->title = 'Contact';
?>
<section>
    <div class="mdb-map">
        <div id="map-container" class="z-depth-1-half map-container"
             style="height: 500px; position: relative; overflow: hidden;">
            <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                <div class="gm-style"
                     style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
                    <div tabindex="0"
                         style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default;">
                        <div style="z-index: 1; position: absolute; top: 0px; left: 0px; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                    <div aria-hidden="true"
                                         style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                        <div style="width: 256px; height: 256px; position: absolute; left: 640px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 384px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 640px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 640px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 896px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 384px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 384px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 896px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 896px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 1152px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 128px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 1152px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 1152px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 128px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 128px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 1408px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: -128px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: -128px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 1408px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: -128px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; position: absolute; left: 1408px; top: 422px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div>
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                                <div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                                    <div aria-hidden="true"
                                         style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 640px; top: 166px;">
                                            <canvas draggable="false" height="256" width="256"
                                                    style="user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;"></canvas>
                                        </div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 384px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 640px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 640px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 896px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 384px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 384px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 896px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 896px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1152px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 128px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1152px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1152px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 128px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 128px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1408px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -128px; top: 166px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -128px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1408px; top: -90px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -128px; top: 422px;"></div>
                                        <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1408px; top: 422px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                <div aria-hidden="true"
                                     style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                    <div style="position: absolute; left: 640px; top: 166px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4824!3i6159!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=95708"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 384px; top: 166px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4823!3i6159!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=18180"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 640px; top: -90px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4824!3i6158!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=59687"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 640px; top: 422px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4824!3i6160!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=55245"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 896px; top: 166px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4825!3i6159!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=42165"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 384px; top: 422px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4823!3i6160!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=108788"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 384px; top: -90px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4823!3i6158!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=113230"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 896px; top: -90px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4825!3i6158!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=6144"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 896px; top: 422px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4825!3i6160!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=1702"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 1408px; top: -90px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4827!3i6158!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=30129"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: -128px; top: 166px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4821!3i6159!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=125266"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: -128px; top: -90px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4821!3i6158!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=89245"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 128px; top: 422px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4822!3i6160!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=31260"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 1408px; top: 166px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4827!3i6159!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=66150"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 1152px; top: -90px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4826!3i6158!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=83672"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 128px; top: -90px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4822!3i6158!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=35702"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 1152px; top: 422px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4826!3i6160!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=79230"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 128px; top: 166px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4822!3i6159!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=71723"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 1152px; top: 166px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4826!3i6159!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=119693"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: -128px; top: 422px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4821!3i6160!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=84803"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                    <div style="position: absolute; left: 1408px; top: 422px; transition: opacity 200ms ease-out;">
                                        <img draggable="false" alt=""
                                             src="https://maps.google.com/maps/vt?pb=!1m5!1m4!1i14!2i4827!3i6160!4i256!2m3!1e0!2sm!3i403099794!3m9!2sru-RU!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;token=25687"
                                             style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gm-style-pbc"
                             style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;">
                            <p class="gm-style-pbt"></p></div>
                        <div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;">
                            <div style="z-index: 1; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;"></div>
                        </div>
                        <div style="z-index: 4; position: absolute; top: 0px; left: 0px; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div>
                            <div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div>
                        </div>
                    </div>
                    <div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;">
                        <a target="_blank"
                           href="https://maps.google.com/maps?ll=40.725118,-73.997699&amp;z=14&amp;t=m&amp;hl=ru-RU&amp;gl=US&amp;mapclient=apiv3"
                           title="Нажмите, чтобы отобразить эту область в Картах Google"
                           style="position: static; overflow: visible; float: none; display: inline;">
                            <div style="width: 66px; height: 26px; cursor: pointer;"><img alt=""
                                                                                          src="https://maps.gstatic.com/mapfiles/api-3/images/google4.png"
                                                                                          draggable="false"
                                                                                          style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; user-select: none; border: 0px; padding: 0px; margin: 0px;">
                            </div>
                        </a></div>
                    <div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 562px; top: 160px;">
                        <div style="padding: 0px 0px 10px; font-size: 16px;">Картографические данные</div>
                        <div style="font-size: 13px;">Картографические данные © 2017 Google</div>
                        <div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;">
                            <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png"
                                 draggable="false"
                                 style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                        </div>
                    </div>
                    <div class="gmnoprint"
                         style="z-index: 1000001; position: absolute; right: 280px; bottom: 0px; width: 208px;">
                        <div draggable="false" class="gm-style-cc"
                             style="user-select: none; height: 14px; line-height: 14px;">
                            <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                <div style="width: 1px;"></div>
                                <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                            </div>
                            <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
                                <a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Картографические
                                    данные</a><span>Картографические данные © 2017 Google</span></div>
                        </div>
                    </div>
                    <div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;">
                        <div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">
                            Картографические данные © 2017 Google
                        </div>
                    </div>
                    <div class="gmnoprint gm-style-cc" draggable="false"
                         style="z-index: 1000001; user-select: none; height: 14px; line-height: 14px; position: absolute; right: 153px; bottom: 0px;">
                        <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                            <div style="width: 1px;"></div>
                            <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                        </div>
                        <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
                            <a href="https://www.google.com/intl/ru-RU_US/help/terms_maps.html" target="_blank"
                               style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Условия
                                использования</a></div>
                    </div>
                    <button draggable="false" title="Включить полноэкранный режим"
                            aria-label="Включить полноэкранный режим" type="button"
                            style="background: none; border: 0px; margin: 10px 14px; padding: 0px; position: absolute; cursor: pointer; user-select: none; width: 25px; height: 25px; overflow: hidden; top: 0px; right: 0px;">
                        <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/sv9.png" draggable="false"
                             class="gm-fullscreen-control"
                             style="position: absolute; left: -52px; top: -86px; width: 164px; height: 175px; user-select: none; border: 0px; padding: 0px; margin: 0px;">
                    </button>
                    <div draggable="false" class="gm-style-cc"
                         style="user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;">
                        <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                            <div style="width: 1px;"></div>
                            <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                        </div>
                        <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
                            <a target="_new" title="Сообщить об ошибке на карте или снимке"
                               href="https://www.google.com/maps/@40.725118,-73.997699,14z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3"
                               style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Сообщить
                                об ошибке на карте</a></div>
                    </div>
                    <div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false"
                         controlwidth="28" controlheight="93"
                         style="margin: 10px; user-select: none; position: absolute; bottom: 107px; right: 28px;">
                        <div class="gmnoprint" controlwidth="28" controlheight="55"
                             style="position: absolute; left: 0px; top: 38px;">
                            <div draggable="false"
                                 style="user-select: none; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255); width: 28px; height: 55px;">
                                <button draggable="false" title="Увеличить" aria-label="Увеличить" type="button"
                                        style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; width: 28px; height: 27px; top: 0px; left: 0px;">
                                    <div style="overflow: hidden; position: absolute; width: 15px; height: 15px; left: 7px; top: 6px;">
                                        <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png"
                                             draggable="false"
                                             style="position: absolute; left: 0px; top: 0px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;">
                                    </div>
                                </button>
                                <div style="position: relative; overflow: hidden; width: 67%; height: 1px; left: 16%; background-color: rgb(230, 230, 230); top: 0px;"></div>
                                <button draggable="false" title="Уменьшить" aria-label="Уменьшить" type="button"
                                        style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; width: 28px; height: 27px; top: 0px; left: 0px;">
                                    <div style="overflow: hidden; position: absolute; width: 15px; height: 15px; left: 7px; top: 6px;">
                                        <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png"
                                             draggable="false"
                                             style="position: absolute; left: 0px; top: -15px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;">
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="gm-svpc" controlwidth="28" controlheight="28"
                             style="background-color: rgb(255, 255, 255); box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; width: 28px; height: 28px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default; position: absolute; left: 0px; top: 0px;">
                            <div style="position: absolute; left: 1px; top: 1px;"></div>
                            <div style="position: absolute; left: 1px; top: 1px;">
                                <div aria-label="Управление человечком в режиме просмотра улиц"
                                     style="width: 26px; height: 26px; overflow: hidden; position: absolute; left: 0px; top: 0px;">
                                    <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout5.png"
                                         draggable="false"
                                         style="position: absolute; left: -147px; top: -26px; width: 215px; height: 835px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                </div>
                                <div aria-label="Человечек находится над картой"
                                     style="width: 26px; height: 26px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;">
                                    <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout5.png"
                                         draggable="false"
                                         style="position: absolute; left: -147px; top: -52px; width: 215px; height: 835px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                </div>
                                <div aria-label="Управление человечком в режиме просмотра улиц"
                                     style="width: 26px; height: 26px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;">
                                    <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout5.png"
                                         draggable="false"
                                         style="position: absolute; left: -147px; top: -78px; width: 215px; height: 835px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                </div>
                            </div>
                        </div>
                        <div class="gmnoprint" controlwidth="28" controlheight="0"
                             style="display: none; position: absolute;">
                            <div title="Повернуть карту на 90&nbsp;градусов"
                                 style="width: 28px; height: 28px; overflow: hidden; position: absolute; background-color: rgb(255, 255, 255); box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; display: none;">
                                <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png"
                                     draggable="false"
                                     style="position: absolute; left: -141px; top: 6px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                            </div>
                            <div class="gm-tilt"
                                 style="width: 28px; height: 28px; overflow: hidden; position: absolute; background-color: rgb(255, 255, 255); box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; top: 0px; cursor: pointer;">
                                <img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png"
                                     draggable="false"
                                     style="position: absolute; left: -141px; top: -13px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                            </div>
                        </div>
                    </div>
                    <div class="gmnoprint"
                         style="margin: 10px; z-index: 0; position: absolute; cursor: pointer; left: 0px; top: 0px;">
                        <div class="gm-style-mtc" style="float: left; position: relative;">
                            <div role="button" tabindex="0" title="Показать карту с названиями объектов"
                                 aria-label="Показать карту с названиями объектов" aria-pressed="true" draggable="false"
                                 style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 8px; border-bottom-left-radius: 2px; border-top-left-radius: 2px; -webkit-background-clip: padding-box; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; min-width: 30px; font-weight: 500;">
                                Карта
                            </div>
                            <div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; left: 0px; top: 29px; text-align: left; display: none;">
                                <div draggable="false" title="Показать карту рельефа с названиями объектов"
                                     style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap;">
                                    <span role="checkbox"
                                          style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;"><div
                                                style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img
                                                    alt="" src="https://maps.gstatic.com/mapfiles/mv/imgs8.png"
                                                    draggable="false"
                                                    style="position: absolute; left: -52px; top: -44px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;"></div></span><label
                                            style="vertical-align: middle; cursor: pointer;">Рельеф</label></div>
                            </div>
                        </div>
                        <div class="gm-style-mtc" style="float: left; position: relative;">
                            <div role="button" tabindex="0" title="Показать спутниковую карту"
                                 aria-label="Показать спутниковую карту" aria-pressed="false" draggable="false"
                                 style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(86, 86, 86); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 8px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; -webkit-background-clip: padding-box; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; min-width: 43px; border-left: 0px;">
                                Спутник
                            </div>
                            <div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; right: 0px; top: 29px; text-align: left; display: none;">
                                <div draggable="false" title="Показать спутниковую карту с названиями объектов"
                                     style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap;">
                                    <span role="checkbox"
                                          style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;"><div
                                                style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img
                                                    alt="" src="https://maps.gstatic.com/mapfiles/mv/imgs8.png"
                                                    draggable="false"
                                                    style="position: absolute; left: -52px; top: -44px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;"></div></span><label
                                            style="vertical-align: middle; cursor: pointer;">Названия объектов</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid mb-5">

    <!--Grid row-->
    <div class="row" style="margin-top: -100px;">

        <!--Grid column-->
        <div class="col-md-12">

            <div class="card pb-5">
                <div class="card-body">

                    <div class="container">

                        <!--Section: Contact v.2-->
                        <section class="section">

                            <!--Section heading-->
                            <h2 class="section-heading h1 pt-4">Contact us</h2>
                            <!--Section description-->
                            <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam.</p>

                            <div class="row pt-5">

                                <!--Grid column-->
                                <div class="col-md-8 col-xl-9">
                                    <form>

                                        <!--Grid row-->
                                        <div class="row">

                                            <!--Grid column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <div class="md-form">
                                                        <input type="text" id="contact-name" class="form-control">
                                                        <label for="contact-name" class="">Your name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Grid column-->

                                            <!--Grid column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <div class="md-form">
                                                        <input type="text" id="contact-email" class="form-control">
                                                        <label for="contact-email" class="">Your email</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Grid column-->

                                        </div>
                                        <!--Grid row-->

                                        <!--Grid row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="md-form">
                                                    <input type="text" id="contact-Subject" class="form-control">
                                                    <label for="contact-Subject" class="">Subject</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Grid row-->

                                        <!--Grid row-->
                                        <div class="row">

                                            <!--Grid column-->
                                            <div class="col-md-12">

                                                <div class="md-form">
                                                    <textarea type="text" id="contact-message" class="md-textarea"></textarea>
                                                    <label for="contact-message">Your message</label>
                                                </div>

                                            </div>
                                        </div>
                                        <!--Grid row-->

                                    </form>

                                    <div class="center-on-small-only">
                                        <a class="btn peach-gradient waves-effect waves-light">Send</a>
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-4 col-xl-3">
                                    <ul class="contact-icons">
                                        <li><i class="fa fa-map-marker fa-2x orange-text"></i>
                                            <p>San Francisco, CA 94126, USA</p>
                                        </li>

                                        <li><i class="fa fa-phone fa-2x orange-text"></i>
                                            <p>+ 01 234 567 89</p>
                                        </li>

                                        <li><i class="fa fa-envelope fa-2x orange-text"></i>
                                            <p>contact@mdbootstrap.com</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--Grid column-->

                            </div>

                        </section>
                        <!--Section: Contact v.2-->

                    </div>
                </div>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </div>

</div>

