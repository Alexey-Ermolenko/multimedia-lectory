<?
/*
 * Класс для получения видео с youtube
 * в формате mp4 c сайта https://www.convertinmp4.com/
 */

namespace app\components;

class VideoConverter
{
    public static function getYoutubeVideoData($youtubeVideoUrl)
    {
        //$youtubeVideoUrl = "https://www.youtube.com/watch?v=CxiqMNUzz54";
        //https://www.convertinmp4.com/youtube.php?video=https://www.youtube.com/watch?v=CxiqMNUzz54
        //https://www.convertinmp4.com/redirect.php?video=k1Yxm-NOqSE&v=0jLbzN5X1np9EEdEfSnmVMaTDWHyv3td
        $converterPage = file_get_contents('https://www.convertinmp4.com/youtube.php?video='.$youtubeVideoUrl);
        /*
         * <a(.*)href\s?=\s?[\"\']?(.[^\"\']*)[\"\'] class="downloadButtons btn btn-lg btn-block btn-success noBorder">Download MP4 \(HD\)
         *
        <a target="_blank" href="redirect.php?video=CxiqMNUzz54&v=TpViQKbmMuBRzqjmU6PljoCZwGwv37mB&amp;hd=1" class="downloadButtons btn btn-lg btn-block btn-success noBorder">Download MP4 (HD)</a>
        <a target="_blank" href="redirect.php?video=CxiqMNUzz54&amp;v=hOobvO0JekE4QvyEIGJK5FFerJtt3yjM" class="downloadButtons btn btn-lg btn-block btn-success borderBottom">Download MP4</a>
        */

        //$re_hd1 = '/<a(.*)href\s?=\s?[\"\']?(.[^\"\']*)[\"\'] class="downloadButtons btn btn-lg btn-block btn-success noBorder">Download MP4 \(HD\)/i';
        $re = '/<a(.*)href\s?=\s?[\"\']?(.[^\"\']*)[\"\'] class="downloadButtons btn btn-lg btn-block btn-success borderBottom">Download MP4/i';

        // preg_match_all($re, $converterPage, $matches, PREG_SET_ORDER, 0);
       // var_dump($matches);
        preg_match($re,$converterPage,$match);
        //print_r($match[2]);
        return $match[2];
    }

    public static function getJSscript($youtubeVideoUrl)
    {
        $data = self::getYoutubeVideoData($youtubeVideoUrl);
        $str = "
            //код для вставки с youtube.com
            videos = document.querySelectorAll('video');
            for (var i = 0, l = videos.length; i < l; i++) {
                var video = videos[i];
                var src = video.src || (function () {
                    var sources = video.querySelectorAll('source');
                    for (var j = 0, sl = sources.length; j < sl; j++) {
                        var source = sources[j];
                        var type = source.type;
                        var isMp4 = type.indexOf('mp4') != -1;
                        if (isMp4) return source.src;
                    }
                    return null;
                })();
                if (src) {
                    var isYoutube = src && src.match(/(?:youtu|youtube)(?:\.com|\.be)\/([\w\W]+)/i);
                    if (isYoutube) {
                        var id = isYoutube[1].match(/watch\?v=|[\w\W]+/gi);
                        id = (id.length > 1) ? id.splice(1) : id;
                        id = id.toString();
                       // var mp4url = 'http://www.convertinmp4.com/redirect.php?video=';
                       // video.src = mp4url + id + '&v=HRC4QzvlgyVC3cPGffGnpal3cm7dTUcJ&hd=1';
                        video.src = 'http://www.convertinmp4.com/".$data."';
                    }
                }
            }
        ";
        return $str;
    }
}