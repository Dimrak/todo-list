<?php


namespace App\Controller;

use Core\Controller;

class ErrorController extends Controller
{
    public function errorPage()
    {
        $this->view->render('404');
    }

    public function errorMethod()
    {
        $this->view->render('404');
    }
}