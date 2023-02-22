<?php
function url_segment($arg = false)
{
    if ($arg === false) {

        $url = $_SERVER['REQUEST_URI'];

        if (isset($_GET)) {
            $url = explode('?', $url);
            $url = $url[0];
        }

        $url = explode('/', trim($url, '/'));

        return $url;
    } else {

        $url = $_SERVER['REQUEST_URI'];

        if (isset($_GET)) {
            $url = explode('?', $url);
            $url = $url[0];
        }

        $url = explode('/', trim($url, '/'));

        array_unshift($url, false);

        if (isset($url[$arg + 1])) {
            return $url[$arg + 1];
        } else {
            return false;
        }
    }

    return false;
}

function urlStrToArray($str)
{
    $string = urldecode($str);
    $replace = str_replace('&amp;', '&', $string);
    parse_str($replace, $return);
    return $return;
}

function get_uri_page()
{
    $url_arr = url_segment();
    $count = 0;
    $page = "";
    foreach ($url_arr as $item) {
        if ($count != 0) {
            $page .= $item . "/";
        }
        $count++;
    }
    $page = trim($page, "/");
    return $page;
}
