<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;
use \App\Models\IncomeModel;
use \App\Models\MethodCatModel;

/**
 * Profile controller
 *
 * PHP version 7.0
 */
class MethodCat extends Authenticated
{
    
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();
        
    }
    
    public function newAction()
    {
        View::renderTemplate('MethodCat/new.html');
    }

    public function createAction()
    {
        $methodCatModel = new MethodCatModel($_POST);
        if ($methodCatModel->save()) {
            Flash::addMessage('New payment method category added');
            $this->redirect('/MethodCat/show');
        } else {
            Flash::addMessage('New payment method category has not been added', Flash::WARNING);
            
            View::renderTemplate('MethodCat/new.html',['methodCatModel' => $methodCatModel
        ]); 

        }

    }

    public function showAction()
    {
        $arg['methods'] = MethodCatModel::getMethodCategories();
        View::renderTemplate('MethodCat/show.html', $arg);
    }

    public function editAction()
    {
        $methodCatModel = new MethodCatModel($_POST);
        $_SESSION['current_category'] = $methodCatModel->findByID($_POST['catId']);
        $arg['cat'] = $_SESSION['current_category'];
        View::renderTemplate('MethodCat/edit.html', $arg);
    }

    public function editedAction()
    {
        $methodCatModel = new MethodCatModel($_POST);
        if ($methodCatModel->edit()) {
            Flash::addMessage('Payment method category name changed');
            $this->redirect('/MethodCat/show');
        } else {
            Flash::addMessage('Payment method category has not been changed', Flash::WARNING);
            $arg['methodCatModel'] =  $methodCatModel;
            $arg['cat'] = $_SESSION['current_category'];
            View::renderTemplate('MethodCat/edit.html', $arg); 
        }
    } 

    public function deleteAction()
    {
        $methodCatModel = new MethodCatModel($_POST);
        if ($methodCatModel->delete()) {
            Flash::addMessage('Payment method with all associated records deleted');
            $this->redirect('/MethodCat/show');
        } else {
            Flash::addMessage('Payment method category has not been deleted', Flash::WARNING);
            $arg['methods'] = MethodCatModel::getMethodCategories();
            View::renderTemplate('MethodCat/show.html', $arg);
        }

    }
}