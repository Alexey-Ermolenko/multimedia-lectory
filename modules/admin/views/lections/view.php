<?
use app\components\UserHelperClass;

/*
$this->title = 'Мультимедиа-лекторий | '. $model['LECTION']['lection_name'];
$this->registerMetaTag(['name' => 'keywords', 'content' => $model['LECTION']['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $model['LECTION']['description']]);
*/
//ML_TODO: DOWORK просмотр лекции в админке; воспроизведение команд

if ($model['LECTION']['file_src'])
{
    $video_src = $model['LECTION']['file_src'];

    if ((stristr($model['LECTION']['file_src'], 'youtu') === FALSE) && (stristr($model['LECTION']['file_src'], 'youtube') === FALSE))
    {
        // Видео из репозитория лектория
        echo $this->render('view\_view_repository_video.php', [
            'model' => $model,
        ]);
    }
    else
    {
        // Видео из youtube
        echo $this->render('view\_view_youtube_video.php', [
            'model' => $model,
        ]);
    }
}