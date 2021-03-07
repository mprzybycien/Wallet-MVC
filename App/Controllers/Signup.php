<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Signup extends \Core\Controller
{

    /**
     * Show the singup page
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Signup/new.html');
    }
    
    public function createAction()
    {
        //echo "dupa";
        $user = new User($_POST);
        
        if ($user->save()){           
            
            $user->sendActivationEmail();
            $this->redirect('/signup/success');
            
            // Cała ścieżka żeby starsze standardy obsługiwały, jak się wpisze w ten sposób to będzie uniwersalnie niezależnie od konfiguracji serwera. 303 - jak się nie poda to kod statusu będzie 302. 303 lepszy bo się nie cashuje
            exit;
        
        } else {
            View::renderTemplate('Signup/new.html', ['user' => $user]);
            
            
        }
        
        
    }
    
    public function successAction()
    {
        View::renderTemplate('Signup/success.html');
    }
    
    public function activateAction()
    {
        User::activate($this->route_params['token']);
        $this->redirect('/signup/activated');
    }
    
    public function activatedAction()
    {
        View::renderTemplate('Signup/activated.html');
    }
}
