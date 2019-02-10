<?php

namespace app\components;

class UserHelperClass
{
    //Yii::$app->userHelperClass->pre('777');
    public static function pre($arr=false)
    {
        $debug = debug_backtrace();
        echo "<pre  style='background:#fff; color:#000; border:1px solid #CCC;padding:10px;border-left:4px solid red; font:normal 11px Arial;'><small>".str_replace($_SERVER['DOCUMENT_ROOT'],"",$debug[0]['file'])." : {$debug[0]['line']}</small>\n".print_r($arr,true)."</pre>";
    }


    public function text_teg_decode($text)
    {
        return str_replace(['&lt;', '&gt;', '&quot;'], ['<', '>', '"'], $text);
    }
    public function add_teg_p($text)
    {
        if($text && !stristr($text, "</p>")) $text = "<p>{$text}</p>";
        return $text;
    }
    public function add_teg_div($text)
    {
        if($text && !stristr($text, "</div>")) $text = "<div>{$text}</div>";
        return $text;
    }

    public function emptyHtmlText($text)
    {
        return strlen(trim(strip_tags($text))) > 0 ? false:true;
    }

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
}