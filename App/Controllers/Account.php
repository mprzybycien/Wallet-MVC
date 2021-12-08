<?php

namespace App\Controllers;

use \App\Models\User;
use \App\Models\ExpenseCatModel;
use \App\Models\MethodCatModel;
use \App\Models\ExpenseModel;

/**
 * Account controller
 *
 * PHP version 7.0
 */
class Account extends \Core\Controller
{
    
    //walidacja email. Sprawdza wczasie rzeczywistym czy email jest unikalny
    public function validateEmailAction()
    {
        $is_valid = ! User::emailExists($_GET['email'], $_GET['ignore_id'] ?? null);
        
        header('Content-Type: application/json');
        echo json_encode($is_valid);
    }
    
    public function validateLimitAction()
    {
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content);
        
        $i = 0;
        
        foreach ($data as $key => $value) {
            
            $a[$i] = $value;
            $i++;
        };

        $category = $a[0];
        $amount = $a[1];
        $date = $a[2];

        $totalExpense = ExpenseModel::totalExpenseByCat($category, $amount, $date);

        $monthlyLimit = ExpenseCatModel::getExpenseLimit($category);

        if(($monthlyLimit > 0) && ($totalExpense > $monthlyLimit)) $limitExceed = true;
        else $limitExceed = false;

        header('Content-Type: application/json');
        echo json_encode($limitExceed);
    }

}

