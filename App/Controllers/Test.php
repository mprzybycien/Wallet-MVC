<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\ExpenseCatModel;
use \App\Models\MethodCatModel;
use \App\Models\ExpenseModel;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Test extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function newAction()
    {
        $arg['expenses'] = ExpenseCatModel::getExpenseCategories();
        $arg['methods'] = MethodCatModel::getMethodCategories();
        View::renderTemplate('Test/new.html', $arg);
    }

    public function createAction()
    {
        $totalExpense = ExpenseModel::totalExpenseByCat($_POST['category'], $_POST['amount'], $_POST['date']) + $_POST['amount'];

        $monthlyLimit = ExpenseCatModel::getExpenseLimit($_POST['category']);

        echo 'dodawany teraz = '.$_POST['amount'].'<br />';
        echo 'wszystkie wydatki = '.$totalExpense.'<br />';
        echo 'limit = '.$monthlyLimit.'<br />';

        if($monthlyLimit == 0) $verdict = 'nie przekroczono';
        else if($totalExpense > $monthlyLimit) $verdict = 'przekroczono';
        else $verdict = 'nie przekroczono';

        echo $verdict;
    }
}
