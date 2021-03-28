<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;
use \App\Models\ExpenseModel;
use \App\Models\ExpenseCatModel;
use \App\Models\MethodCatModel;

/**
 * Expense controller
 *
 * PHP version 7.0
 */
class Expense extends Authenticated
{
    
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();
        
    }
    
    
    public function newAction()
    {
        $arg['expenses'] = ExpenseCatModel::getExpenseCategories();
        $arg['methods'] = MethodCatModel::getPaymentMethods();
        View::renderTemplate('Expense/new.html', $arg);
    }

    public function createAction()
    {
        $expenseModel = new ExpenseModel($_POST);
        
        if ($expenseModel->save()) {
        Flash::addMessage('Expense added');

        $this->redirect('/Expense/new');

        } else {
        Flash::addMessage('Expense has not been added', Flash::WARNING);

        $arg['expenseModel'] = $expenseModel;
        $arg['expenses'] = ExpenseCatModel::getExpenseCategories();
        $arg['methods'] = MethodCatModel::getPaymentMethods();
        
        View::renderTemplate('Expense/new.html', $arg);  
        }

  
    }
    
}