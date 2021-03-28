<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;
use \App\Models\IncomeModel;
use \App\Models\ExpenseCatModel;

/**
 * Profile controller
 *
 * PHP version 7.0
 */
class ExpenseCat extends Authenticated
{
    
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();
        
    }
    
    public function newAction()
    {
        View::renderTemplate('ExpenseCat/new.html');
    }

    public function createAction()
    {
        $expenseCatModel = new ExpenseCatModel($_POST);
        if ($expenseCatModel->save()) {
            Flash::addMessage('New expense category added');
            $this->redirect('/ExpenseCat/show');
        } else {
            Flash::addMessage('New expense category has not been added', Flash::WARNING);
            
            View::renderTemplate('ExpenseCat/new.html',['expenseCatModel' => $expenseCatModel
        ]); 

        }

    }

    public function showAction()
    {
        $arg['expenses'] = ExpenseCatModel::getExpenseCategories();
        View::renderTemplate('ExpenseCat/show.html', $arg);
    }

    public function editAction()
    {
        $expenseCatModel = new ExpenseCatModel($_POST);
        $arg['cat'] = $expenseCatModel->findByID($_POST['catId']);
        View::renderTemplate('ExpenseCat/edit.html', $arg);
    }

    public function editedAction()
    {
        $expenseCatModel = new ExpenseCatModel($_POST);
        if ($expenseCatModel->edit()) {
            Flash::addMessage('Expense category name changed');
            $this->redirect('/ExpenseCat/show');
        } else {
            Flash::addMessage('Expense category has not been changed', Flash::WARNING);
            View::renderTemplate('ExpenseCat/edit.html', ['expenseCatModel' => $expenseCatModel
        ]); 
        }
    } 

    public function deleteAction()
    {
        $expenseCatModel = new ExpenseCatModel($_POST);
        if ($expenseCatModel->delete()) {
            Flash::addMessage('Expense category deleted');
            $this->redirect('/ExpenseCat/show');
        } else {
            Flash::addMessage('Expense category has not been deleted', Flash::WARNING);
            $arg['expenses'] = ExpenseCatModel::getExpenseCategories();
            View::renderTemplate('ExpenseCat/show.html', $arg);
        }

    }
}