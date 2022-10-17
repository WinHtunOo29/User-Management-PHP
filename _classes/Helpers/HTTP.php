<?php

namespace Helpers;

class HTTP {
    static $base = "http://localhost/Professional Web Developer 2022/Session";
    static function redirect($path, $query="")
    {
        $url = static::$base . $path;
        if($query) $url .= "?$query";
        header("location: $url");
        exit();
    }
}