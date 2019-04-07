<?php

namespace app\components;

use yii\base\Exception;

class UserHelperClass
{
    /**
     * @param bool $arr
     */
    public static function pre($arr=false)
    {
        $debug = debug_backtrace();
        echo "<pre  style='background:#fff; color:#000; border:1px solid #CCC;padding:10px;border-left:4px solid red; font:normal 11px Arial;'><small>".str_replace($_SERVER['DOCUMENT_ROOT'],"",$debug[0]['file'])." : {$debug[0]['line']}</small>\n".print_r($arr,true)."</pre>";
    }

    /**
     * @param $text
     * @return mixed
     */
    public function text_teg_decode($text)
    {
        return str_replace(['&lt;', '&gt;', '&quot;'], ['<', '>', '"'], $text);
    }

    /**
     * @param $text
     * @return string
     */
    public function add_teg_p($text)
    {
        if($text && !stristr($text, "</p>")) $text = "<p>{$text}</p>";
        return $text;
    }

    /**
     * @param $text
     * @return string
     */
    public function add_teg_div($text)
    {
        if($text && !stristr($text, "</div>")) $text = "<div>{$text}</div>";
        return $text;
    }

    /**
     * @param $text
     * @return bool
     */
    public function emptyHtmlText($text)
    {
        return strlen(trim(strip_tags($text))) > 0 ? false:true;
    }

    /**
     * @param $path
     * @return bool
     */
    public static function rmRec($path)
    {
        if (is_file($path))
        {
            return unlink($path);
        }
        if (is_dir($path))
        {
            foreach(scandir($path) as $p)
            {
                if (($p!='.') && ($p!='..'))
                {
                    self::rmRec($path.DIRECTORY_SEPARATOR.$p);
                }
            }
            return rmdir($path);
        }
        return false;
    }

    /**
     * @param $url
     * @param $path
     * @return bool
     * @throws Exception
     */
    public static function downloadFile($url, $path)
    {
        if (!preg_match("/^https?:/i", $url) && filter_var($url, FILTER_VALIDATE_URL))
        {
            throw new Exception('Укажите корректную ссылку на удалённый файл.');
            return false;
        }
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_TIMEOUT => 60,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_NOPROGRESS => 1,
            CURLOPT_BUFFERSIZE => 1024,
            CURLOPT_PROGRESSFUNCTION => function ($ch, $dwnldSize, $dwnld, $upldSize, $upld) {
                if ($dwnld > 1024 * 1024 * 5)
                {
                    return -1;
                }
            },

        ]);
        $raw = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_errno($ch);

        curl_close($ch);

        if ($error === CURLE_OPERATION_TIMEDOUT)
        {
            throw new Exception('Превышен лимит ожидания.');
            return false;
        }
        if ($error === CURLE_ABORTED_BY_CALLBACK)
        {
            throw new Exception('Размер не должен превышать 5 Мбайт.');
            return false;
        }
        if ($info['http_code'] !== 200)
        {
            throw new Exception('Файл не доступен.');
            return false;
        }

        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string)finfo_buffer($fi, $raw);
        finfo_close($fi);


        if (strpos($mime, 'image') === false)
        {
            throw new Exception('Можно загружать только изображения.');
            return false;
        }
        $image = getimagesizefromstring($raw);
        $limitWidth = 12280;
        $limitHeight = 10768;

        if ($image[1] > $limitHeight)
        {
            throw new Exception('Высота изображения не должна превышать 10768 точек.');
            return false;
        }
        if ($image[0] > $limitWidth)
        {
            throw new Exception('Ширина изображения не должна превышать 12280 точек.');
            return false;
        }

        $name = md5($raw);
        $extension = image_type_to_extension($image[2]);
        $format = str_replace('jpeg', 'jpg', $extension);


        if (!file_put_contents($path . $name . $format, $raw))
        {
            throw new Exception('При сохранении изображения на диск произошла ошибка.');
            return false;
        }
        else
        {
            $result = $path . $name . $format;
            return $result;
        }
    }

    /**
     * @param $filePath
     * @return void
     */
    public static function deleteDownloadFile($filePath)
    {
        self::rmRec($filePath);
    }
}