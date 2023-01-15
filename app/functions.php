<?php

function thumbUrl($path, $size_w = 600, $size_h = 500, $style = '')
{
    if (!$path) return '';
    $ext = explode('.', $path);
    $ext = end($ext);

    if($ext=='png') $path = PATH . "thumb/phpThumb.php?" . "src=" . $path . "&w=$size_w&h=$size_h&zc=1&f=png";
    else $path = PATH . "thumb/phpThumb.php?" . "src=" . $path . "&w=$size_w&h=$size_h&zc=1";
    return $path;
}