<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\ExpenseModel;
use \App\Models\IncomeModel;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        
        if(isset($_SESSION['user_id'])) {
        $dates['for'] = date('Y-m-00');
        $dates['to'] = date("Y-m-t");

        $expensesModel = new ExpenseModel();
        $incomesModel = new IncomeModel();

        $arg['expenses'] = $expensesModel -> getExpensesSum($dates);
        $arg['incomes'] = $incomesModel -> getIncomesSum($dates);
        View::renderTemplate('Home/index.html', $arg);       
        } else View::renderTemplate('Home/index.html');
    }
}
