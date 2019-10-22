<?php
namespace Core;

class View
{
    public $url;

    public function render($template = '')
    {
        $path = __DIR__;
        $path = str_replace('core', '', $path);
//        dd($path.'views/pages/header.php');
        include $path.'views/pages/header.php';
        include $path . 'views/' . $template . '.php';
//        include $path.'views/pages/footer.php';
    }
}