<?php

function url($path)
{
//    return 'Place here your url for the project' . $path;
}

function urlStyle($path)
{
//    return 'Place here your url for the styles' . $path;
}
function dd($data)
{
    echo '<pre>';
    print_r($data);
    die();
}

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
}