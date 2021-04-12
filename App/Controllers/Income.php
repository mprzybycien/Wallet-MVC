<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;
use \App\Models\IncomeModel;
use \App\Models\IncomeCatModel;
use \App\Models\StatsModel;

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
        $this->redirect('/');

        } else {
        Flash::addMessage('Income has not been added', Flash::WARNING);

        $arg['incomeModel'] = $incomeModel;
        $arg['incomes'] = IncomeCatModel::getIncomeCategories();
        View::renderTemplate('Income/new.html', $arg);  
        }
    }

    public function setAction()
    {
        View::renderTemplate('Income/set.html');
    }

    public function showAction()
    {
        $incomeModel = new IncomeModel($_POST);
        $incomesPeroid = $incomeModel-> getPeroid();
        if($incomeModel->getIncomes($incomesPeroid)){
            $incomes['incomes'] = $incomeModel->getIncomes($incomesPeroid);
            View::renderTemplate('Income/show.html', $incomes);
        } else {
            Flash::addMessage('No incomes were found during this period', Flash::WARNING);
            View::renderTemplate('Income/set.html');
        }
    }

    public function editAction()
    {
        $incomeModel = new IncomeModel($_POST);
        $incomeCatModel = new IncomeCatModel();
        
        $currentIncome = $_SESSION['current_income'] = $incomeModel->findByID($_POST['incomeId']);

        $_SESSION['current_income_category'] = $incomeCatModel->findByID($currentIncome->income_category_assigned_to_user_id);

        $arg['income'] = $_SESSION['current_income'];
        $arg['categories'] = IncomeCatModel::getIncomeCategories();
        $arg['income_category'] = $_SESSION['current_income_category'];

        View::renderTemplate('Income/edit.html', $arg);

    }

    public function editedAction()
    {
        $incomeModel = new IncomeModel($_POST);
        if ($incomeModel-> edit()){
            Flash::addMessage('Income data changed');
            $this->redirect('/income/set');
        } else {
            Flash::addMessage('Income data has not been edited', Flash::WARNING);

            $incomeCatModel = new IncomeCatModel($_POST);
            
            $arg['income'] = $_SESSION['current_income'];
            $arg['categories'] = IncomeCatModel::getIncomeCategories();
            $arg['income_category'] = $_SESSION['current_income_category'];
            $arg['incomeModel'] = $incomeModel;
            
            View::renderTemplate('Income/edit.html', $arg);
        }
    }

    public function deleteAction()
    {
        $incomeModel = new IncomeModel($_POST);
        if ($incomeModel->delete()) {
            Flash::addMessage('Income deleted');
            $this->redirect('/');
        } else {
            Flash::addMessage('Income has not been deleted', Flash::WARNING);
            $incomeCatModel = new IncomeCatModel($_POST);
            
            $arg['income'] = $_SESSION['current_income'];
            $arg['categories'] = IncomeCatModel::getIncomeCategories();
            $arg['income_category'] = $_SESSION['current_income_category'];
            $arg['incomeModel'] = $incomeModel;
            View::renderTemplate('Income/show.html', $arg);
        }

    }

    public function statsAction()
    {
       View::renderTemplate('Income/stats.html');
    }

    public function chartAction()
    {
        $incomeModel = new IncomeModel($_POST);
        $stats = new StatsModel;
        $incomesPeroid = $incomeModel-> getPeroid();

        if($stats->getIncomeTotalSum($incomesPeroid)){
            $arg['incomesTotalSum'] = $stats->getIncomeTotalSum($incomesPeroid);
            View::renderTemplate('Income/chart.html', $arg);
        } else {
            Flash::addMessage('No incomes were found during this period', Flash::WARNING);
            View::renderTemplate('Income/stats.html');
        }
    }




    
}