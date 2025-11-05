<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

function routeIs($routeName, $exact=true) :bool
{
    $path = route($routeName, null, false);
    $path = Str::substr($path, 1);

    if(!$exact)
        $path = "$path*";
    
    return Request::is($path);
}