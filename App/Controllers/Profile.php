<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\Currency;


/**
 * Profile controller
 *
 * PHP version 7.0
 */
class Profile extends Authenticated
{
    
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();
    }
    
    public function showAction()
    {
        View::renderTemplate('Profile/show.html', [
            'user' => $this->user
            ]);
    }
    
    public function editAction()
    {
        $currency = new Currency();
        $currency = $currency->getCurrencies();
        
        $arg['currencies'] =  $currency;
        $arg['user'] =  $this->user;
        
        View::renderTemplate('Profile/edit.html', $arg);
    }

    public function updateAction()
    {
        if ( $this->user->updateProfile($_POST)) {

            Flash::addMessage('Changes saved');
            $this->redirect('/profile/show');

        } else {
            View::renderTemplate('Profile/edit.html', [
                'user' =>  $this->user
            ]);
        }
    }
}
