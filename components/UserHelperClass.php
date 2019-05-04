<?php

namespace app\components;

use yii\base\Exception;

class UserHelperClass
{
    /**
     * @param bool $arr
     */
    public static function pre($arr = false)
    {
        $debug = debug_backtrace();
        echo "<pre  style='background:#fff; color:#000; border:1px solid #CCC;padding:10px;border-left:4px solid red; font:normal 11px Arial;'><small>" . str_replace($_SERVER['DOCUMENT_ROOT'], "", $debug[0]['file']) . " : {$debug[0]['line']}</small>\n" . print_r($arr, true) . "</pre>";
    }

    /**
     * @param $url
     * @param $path
     * @return bool
     * @throws Exception
     */
    public static function downloadFile($url, $path)
    {
        if (!preg_match("/^https?:/i", $url) && filter_var($url, FILTER_VALIDATE_URL)) {
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
                if ($dwnld > 1024 * 1024 * 5) {
                    return -1;
                }
            },

        ]);
        $raw = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_errno($ch);

        curl_close($ch);

        if ($error === CURLE_OPERATION_TIMEDOUT) {
            throw new Exception('Превышен лимит ожидания.');
            return false;
        }
        if ($error === CURLE_ABORTED_BY_CALLBACK) {
            throw new Exception('Размер не должен превышать 5 Мбайт.');
            return false;
        }
        if ($info['http_code'] !== 200) {
            throw new Exception('Файл не доступен.');
            return false;
        }

        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string)finfo_buffer($fi, $raw);
        finfo_close($fi);


        if (strpos($mime, 'image') === false) {
            throw new Exception('Можно загружать только изображения.');
            return false;
        }
        $image = getimagesizefromstring($raw);
        $limitWidth = 12280;
        $limitHeight = 10768;

        if ($image[1] > $limitHeight) {
            throw new Exception('Высота изображения не должна превышать 10768 точек.');
            return false;
        }
        if ($image[0] > $limitWidth) {
            throw new Exception('Ширина изображения не должна превышать 12280 точек.');
            return false;
        }

        $name = md5($raw);
        $extension = image_type_to_extension($image[2]);
        $format = str_replace('jpeg', 'jpg', $extension);


        if (!file_put_contents($path . $name . $format, $raw)) {
            throw new Exception('При сохранении изображения на диск произошла ошибка.');
            return false;
        } else {
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

    /**
     * @param $path
     * @return bool
     */
    public static function rmRec($path)
    {
        if (is_file($path)) {
            return unlink($path);
        }
        if (is_dir($path)) {
            foreach (scandir($path) as $p) {
                if (($p != '.') && ($p != '..')) {
                    self::rmRec($path . DIRECTORY_SEPARATOR . $p);
                }
            }
            return rmdir($path);
        }
        return false;
    }

    /**
     * @param $text
     * @return string
     */
    public static function getTextImage($text)
    {
        $font = $_SERVER['DOCUMENT_ROOT'].'/web/font/roboto/Roboto-Bold.ttf';
        $text = urldecode($text);
        $imgWidth = 350;
        $imgHeight = 250;
        // Create image and define colors
        $image = imagecreate($imgWidth, $imgHeight);
        $colorWhite = imagecolorallocate($image, 255, 255, 255);
        $colorGrey = imagecolorallocate($image, 192, 192, 192);
        $colorBlue = imagecolorallocate($image, 0, 0, 255);


        $font_size = 13;
        $width_text = 340;
        $padTop = 0;
        $ret = "";

        $arr = explode(' ', $text);
        if (count($arr) > 10) {
            $font_size = 9;
        }

        foreach ($arr as $word) {
            $tmp_string = $ret . ' ' . $word;
            $testbox = imagettfbbox($font_size, 0, $font, $tmp_string);
            if ($testbox[2] > $width_text) $ret .= ($ret == "" ? "" : "\n") . $word;
            else $ret .= ($ret == "" ? "" : " ") . $word;
        }
        $arr = explode("\n", $ret);
        foreach ($arr as $str) {
            $testbox = imagettfbbox($font_size, 0, $font, $str);// Размер строки
            $left_x = round(($width_text - ($testbox[2] - $testbox[0])) / 2);
            imagettftext($image, $font_size, 0, $left_x + 0, $padTop + 50, 0x0000FF, $font, $str);
            $padTop = $padTop + $font_size * 1.5;
        }

        ob_start();
        imagejpeg($image, null, 100);
        $imagedata = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);

        return $imagedata;
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
        if ($text && !stristr($text, "</p>")) $text = "<p>{$text}</p>";
        return $text;
    }

    /**
     * @param $text
     * @return string
     */
    public function add_teg_div($text)
    {
        if ($text && !stristr($text, "</div>")) $text = "<div>{$text}</div>";
        return $text;
    }

    /**
     * @param $text
     * @return bool
     */
    public function emptyHtmlText($text)
    {
        return strlen(trim(strip_tags($text))) > 0 ? false : true;
    }
}