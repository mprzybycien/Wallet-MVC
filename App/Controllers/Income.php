<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;
use \App\Models\IncomeModel;
use \App\Models\IncomeCatModel;

/**
 * Profile controller
 *
 * PHP version 7.0
 */
class Income extends Authenticated
{
    
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();
        
    }
    
    public function newAction()
    {
        $arg['incomes'] = IncomeCatModel::getIncomeCategories();
        View::renderTemplate('Income/new.html', $arg);
    }

    public function createAction()
    {
        $incomeModel = new IncomeModel($_POST);
        
        if ($incomeModel->save()) {
        Flash::addMessage('Income added');

        $this->redirect('/Income/new');

        } else {
        Flash::addMessage('Income has not been added', Flash::WARNING);

        $arg['incomeModel'] = $incomeModel;
        $arg['incomes'] = IncomeCatModel::getIncomeCategories();
        View::renderTemplate('Income/new.html', $arg);  
        }
    }
}