<?
use app\components\userHelperClass;
/*
$this->title = 'Мультимедиа-лекторий | '. $model['lection_name'];
$this->registerMetaTag(['name' => 'keywords', 'content' => $model['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $model['description']]);
*/
/*
$arLection = [
    'video'=> $model,
    'demonstrations'=> $demonstrations_model,
];
*/

//Yii::$app->userHelperClass->pre($json);

//ML_TODO: вывод слайдов
//ML_TODO: массив json
//ML_TODO: синхронизация слайдов с видео

if ($model['file_src'])
{
    /** @var TYPE_NAME $video_src */
    $video_src = $model['file_src'];

    if ((stristr($model['file_src'], 'youtu') === FALSE) && (stristr($model['file_src'], 'youtube') === FALSE))
    {
        // Видео из репозитория лектория
        /** @var TYPE_NAME $demonstrations_model */
        echo $this->render('view/_view_repository_video.php', [
            'demonstrations_model' => $demonstrations_model,
            'model' => $model,
        ]);
    }
    else
    {
        // Видео из youtube
        /** @var TYPE_NAME $demonstrations_model */
        echo $this->render('view/_view_youtube_video.php', [
            'demonstrations_model' => $demonstrations_model,
            'model' => $model,
        ]);
    }
}
