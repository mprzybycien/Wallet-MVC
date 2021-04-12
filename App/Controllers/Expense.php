<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;
use \App\Models\ExpenseModel;
use \App\Models\ExpenseCatModel;
use \App\Models\MethodCatModel;
use \App\Models\StatsModel;

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
        $arg['methods'] = MethodCatModel::getMethodCategories();
        View::renderTemplate('Expense/new.html', $arg);
    }

    public function createAction()
    {
        $expenseModel = new ExpenseModel($_POST);
        
        if ($expenseModel->save()) {
        Flash::addMessage('Expense added');

        $this->redirect('/');

        } else {
        Flash::addMessage('Expense has not been added', Flash::WARNING);

        $arg['expenseModel'] = $expenseModel;
        $arg['expenses'] = ExpenseCatModel::getExpenseCategories();
        $arg['methods'] = MethodCatModel::getMethodCategories();
        
        View::renderTemplate('Expense/new.html', $arg);  
        }

  
    }

    public function setAction()
    {
        View::renderTemplate('Expense/set.html');
    }

    public function showAction()
    {
        $expenseModel = new ExpenseModel($_POST);
        $expensesPeroid = $expenseModel-> getPeroid();
        if($expenseModel->getExpenses($expensesPeroid)) {
            $expenses['expenses'] = $expenseModel->getExpenses($expensesPeroid);
            View::renderTemplate('Expense/show.html', $expenses);
        } else {
            Flash::addMessage('No expenses were found during this period', Flash::WARNING);
            View::renderTemplate('Expense/set.html');
        }
    }

    public function editAction()
    {

        $expenseModel = new ExpenseModel($_POST);
        $expenseCatModel = new ExpenseCatModel();
        $methodCatModel = new MethodCatModel();


        $currentExpense = $_SESSION['current_expense'] = $expenseModel->findByID($_POST['expenseId']);

        $_SESSION['current_expense_category'] = $expenseCatModel->findByID($currentExpense->expense_category_assigned_to_user_id);

        $_SESSION['current_expense_method'] = $methodCatModel->findByID($currentExpense->payment_method_assigned_to_user_id);

        $arg['expense'] = $_SESSION['current_expense'];
        $arg['categories'] = ExpenseCatModel::getExpenseCategories();
        $arg['methods'] = MethodCatModel::getMethodCategories();
        $arg['expense_category'] = $_SESSION['current_expense_category'];
        $arg['method_category'] = $_SESSION['current_expense_method'];

        View::renderTemplate('Expense/edit.html', $arg);
    }

    public function editedAction()
    {
        $expenseModel = new ExpenseModel($_POST);
        if ($expenseModel-> edit()){
            Flash::addMessage('Expense data changed');
            $this->redirect('/expense/set');
        } else {
            Flash::addMessage('Expense data has not been edited', Flash::WARNING);

            $expenseCatModel = new ExpenseCatModel($_POST);
            
            $arg['expense'] = $_SESSION['current_expense'];
            $arg['categories'] = ExpenseCatModel::getExpenseCategories();
            $arg['methods'] = MethodCatModel::getMethodCategories();
            $arg['expense_category'] = $_SESSION['current_expense_category'];
            $arg['method_category'] = $_SESSION['current_expense_method'];
            $arg['expenseModel'] = $expenseModel;
            
            View::renderTemplate('Expense/edit.html', $arg);
        }
    }

    public function deleteAction()
    {
        $expenseModel = new ExpenseModel($_POST);
        if ($expenseModel->delete()) {
            Flash::addMessage('Expense deleted');
            $this->redirect('/');
        } else {
            Flash::addMessage('Expense has not been deleted', Flash::WARNING);
            $expenseCatModel = new ExpenseCatModel($_POST);
            
            $arg['expense'] = $_SESSION['current_expense'];
            $arg['categories'] = ExpenseCatModel::getExpenseCategories();
            $arg['methods'] = MethodCatModel::getMethodCategories();
            $arg['expense_category'] = $_SESSION['current_expense_category'];
            $arg['method_category'] = $_SESSION['current_expense_method'];
            $arg['expenseModel'] = $expenseModel;
            View::renderTemplate('Expense/show.html', $arg);
        }

    }

    public function statsAction()
    {
       View::renderTemplate('Expense/stats.html');
    }

    public function chartAction()
    {
        $expenseModel = new ExpenseModel($_POST);
        $stats = new StatsModel;
        $expensesPeroid = $expenseModel-> getPeroid();

        if($stats->getExpenseTotalSum($expensesPeroid)){
            $arg['expensesTotalSum'] = $stats->getExpenseTotalSum($expensesPeroid);
            View::renderTemplate('Expense/chart.html', $arg);
        } else {
            Flash::addMessage('No expenses were found during this period', Flash::WARNING);
            View::renderTemplate('Expense/stats.html');
        }
    }
    
}