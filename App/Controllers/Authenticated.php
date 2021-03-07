<?php

namespace App\Controllers;

/**
 * Authenticated bas controller
 *
 * PHP version 7.0
 */
abstract class Authenticated extends \Core\Controller
{
    
    protected function before()
    {
        $this->requireLogin();
    }
}
