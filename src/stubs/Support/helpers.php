<?php
use Jenssegers\Date\Date;

function locale(): string
{
    return app()->getLocale();
}

function locales(): Collection
{
    return collect(config('app.locales'));
}

function str_tease(string $string, $length = 200, $moreTextIndicator = '...')
{
    $string = trim($string);

    //remove html
    $string = strip_tags($string);

    //replace multiple spaces
    $string = preg_replace("/\s+/", ' ', $string);

    if (strlen($string) == 0) {
        return '';
    }

    if (strlen($string) <= $length) {
        return $string;
    }

    $ww = wordwrap($string, $length, "\n");

    $string = substr($ww, 0, strpos($ww, "\n")).$moreTextIndicator;

    return $string;
}

function diff_date_for_humans($date) : string
{
    return (new Date($date))->ago();
}

function get_month_date($date): string
{
    Date::setLocale(config('app.locale'));
    return (new Date($date))->format('F');
}

function format_urls_in_text(string $text, bool $short = false): string
{
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-z]+(\/\S*)?/";

    preg_match_all($reg_exUrl, $text, $matches);
    $usedPatterns = [];

    foreach($matches[0] as $pattern)
    {
        $shortPattern = preg_replace('#^https?://#', '', $pattern);
        $link = ($short) ? $shortPattern : $pattern;

        if(!array_key_exists($pattern, $usedPatterns)) {
            $usedPatterns[$pattern] = true;
            $text = str_replace($pattern, "<a href=\"$pattern\" rel=\"nofollow\" target=\"_blank\">$link</a>", $text);
        }
    }

    return $text;
}

    function format_shorturls_in_text(string $text): string
    {
        return format_urls_in_text($text, true);
    }

function nl2li(string $text, string $itemClass = '', string $container = 'ul'): string
{
    return "<$container><li class=\"$itemClass\">" . str_replace("\n", '</li><li>', trim($text)) . "</li></$container>";
}

function getVideoYoutubeThumbByUrl($url, $vq='maxresdefault')
{
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);

    $video_id = $params['v'];

    return getVideoYoutubeThumbByVideoID($video_id, $vq);
}

function getVideoYoutubeThumbByVideoID($video_id, $vq='maxresdefault')
{
    $output = (!empty($video_id)) ? "https://img.youtube.com/vi/$video_id/$vq.jpg" : null;

    return $output;
}