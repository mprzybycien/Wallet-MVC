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
class IncomeCat extends Authenticated
{
    
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();
        
    }
    
    public function newAction()
    {
        View::renderTemplate('IncomeCat/new.html');
    }

    public function createAction()
    {
        $incomeCatModel = new IncomeCatModel($_POST);
        if ($incomeCatModel->save()) {
            Flash::addMessage('New income category added');
            $this->redirect('/IncomeCat/show');
        } else {
            Flash::addMessage('New income category has not been added', Flash::WARNING);
            
            View::renderTemplate('IncomeCat/new.html',['incomeCatModel' => $incomeCatModel
        ]); 

        }

    }

    public function showAction()
    {
        $arg['incomes'] = IncomeCatModel::getIncomeCategories();
        View::renderTemplate('IncomeCat/show.html', $arg);
    }

    public function editAction()
    {
        $incomeCatModel = new IncomeCatModel($_POST);
        $arg['cat'] = $incomeCatModel->findByID($_POST['catId']);
        View::renderTemplate('IncomeCat/edit.html', $arg);
    }

    public function editedAction()
    {
        $incomeCatModel = new IncomeCatModel($_POST);
        if ($incomeCatModel->edit()) {
            Flash::addMessage('Income category name changed');
            $this->redirect('/IncomeCat/show');
        } else {
            Flash::addMessage('Income category has not been changed', Flash::WARNING);
            View::renderTemplate('IncomeCat/edit.html', ['incomeCatModel' => $incomeCatModel
        ]); 
        }
    } 

    public function deleteAction()
    {
        $incomeCatModel = new IncomeCatModel($_POST);
        if ($incomeCatModel->delete()) {
            Flash::addMessage('Income category deleted');
            $this->redirect('/IncomeCat/show');
        } else {
            Flash::addMessage('Income category has not been deleted', Flash::WARNING);
            $arg['incomes'] = IncomeCatModel::getIncomeCategories();
            View::renderTemplate('IncomeCat/show.html', $arg);
        }

    }
}