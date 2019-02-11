<?
use app\components\UserHelperClass;

/*
$this->title = 'Мультимедиа-лекторий | Запись лекции №'.$lectionModel['id'];

$this->registerMetaTag(['name' => 'keywords', 'content' => $model['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $model['description']]);
*/
//ML_TODO: запись комманд

if ($video['file_src'])
{
    $video_src = $video['file_src'];

    if ((stristr($video['file_src'], 'youtu') === FALSE) && (stristr($video['file_src'], 'youtube') === FALSE))
    {
        // Видео из репозитория лектория
        echo $this->render('rec_video/_rec_repository_video.php', [
            'id'=>$id,
            'idscn'=>$idscn,
            'arDemos'=>$arDemos,
            'lectionModel' => $lectionModel,
            'video' => $video
        ]);
    }
    else
    {
        // Видео из youtube
        echo $this->render('rec_video/_rec_youtube_video.php',[
            'id'=>$id,
            'idscn'=>$idscn,
            'arDemos'=>$arDemos,
            'lectionModel' => $lectionModel,
            'video' => $video
        ]);
    }
}
?>