<?
namespace app\components;


class YouTubeVideo
{
    /**
     * @param $url
     * @return bool|mixed|string
     */
    static function getYoutubeCodeFromURL($url)
	{
		$yCode = "";
		$url = trim($url);
		$url = parse_url($url);
		if(preg_match("/youtube/i",$url["host"]))
		{
			$urlParamsSrc = explode("&",$url["query"]);
			$urlParams = array();
			foreach($urlParamsSrc as $p)
			{
				list($k,$v) = explode("=",$p);
				$urlParams[$k] = $v;
			}
			
			$yCode = false;
			if(!empty($urlParams["v"]))$yCode = $urlParams["v"];
			return $yCode;
		}
		return false;
	}

    /**
     * @param $url
     * @return bool|string
     */
    public static function getHQPreviewByLink($url)
	{
		$yCode = self::getYoutubeCodeFromURL($url);
		if($yCode!==false)return "http://i2.ytimg.com/vi/".$yCode."/hqdefault.jpg";//480x360
		else return false;
	}

    /**
     * @param $url
     * @return bool|string
     */
    public static function getSmallPreviewByLink($url)
	{
		$yCode = YouTubeVideo::getYoutubeCodeFromURL($url);
		if($yCode!==false)return "http://i2.ytimg.com/vi/".$yCode."/default.jpg";//120x90
		else return false;
	}

    /**
     * @param $url
     * @param int $width
     * @param int $height
     * @return bool|mixed
     */
    public static function insertHTMLVideo($url, $width=480, $height=390)
	{
		$yCode = YouTubeVideo::getYoutubeCodeFromURL($url);
		if($yCode!==false)
		{
			?>
            <iframe
                id="player"
                title="YouTube video player"
                width="<?=$width?>"
                height="<?=$height?>"
                src="http://www.youtube.com/embed/<?=$yCode?>?controls=2&modestbranding=1&rel=0&autohide=1&wmode=transparent&rel=0&enablejsapi=1&origin=*"
                frameborder="0"
                allowfullscreen
            >
            </iframe>
            <?
		}
		else return false;
	}

    /**
     * @param $url
     * @return bool|int
     */
    public static function getViewsCount($url)
	{
		$yCode = YouTubeVideo::getYoutubeCodeFromURL($url);
		if($yCode!==false)
		{
			$apiUrl = "http://gdata.youtube.com/feeds/api/videos/".$yCode;
			$str = file_get_contents($apiUrl);
			preg_match("#viewCount=['\"]([0-9]+)['\"]#i",$str,$matches);
			return intval($matches[1]);
		}
		else return false;
	}
	
}
?>