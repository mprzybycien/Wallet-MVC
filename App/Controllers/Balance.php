<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;
use \App\Models\ExpenseModel;
use \App\Models\IncomeModel;
use \App\Models\ExpenseCatModel;
use \App\Models\MethodCatModel;
use \App\Models\StatsModel;

/**
 * Expense controller
 *
 * PHP version 7.0
 */
class Balance extends Authenticated
{
    
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();     
    }
    
    public function chartAction()
    {
        $stats = new StatsModel;

        $arg['currentIncomes'] = $stats->getIncomesSum($stats->getCurrentMonthDates());
        $arg['previousIncomes'] = $stats->getIncomesSum($stats->getPreviousMonthDates());
        $arg['allIncomes'] = $stats->getAllIncomesSum();

        $arg['currentExpenses'] = $stats->getExpensesSum($stats->getCurrentMonthDates());
        $arg['previousExpenses'] = $stats->getExpensesSum($stats->getPreviousMonthDates());
        $arg['allExpenses'] = $stats->getAllExpensesSum();

    
        View::renderTemplate('Balance/chart.html', $arg);
    }
    
}