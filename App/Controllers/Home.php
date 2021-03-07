<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
      /*  Test wysyłania maila
        \App\Mail::send(
            'poczta@mateuszprzybycien.pl', 
            'test', 
            'This is a test',
            '<h1>This is a test</h1>');
        */
        View::renderTemplate('Home/index.html');
    }
}
