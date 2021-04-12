<?php

namespace App\Models;

use PDO;
use \App\Token;
use \App\Mail;
use \Core\View;

/**
 * Example user model
 *
 * PHP version 7.0
income_category_assigned_to_user_id, sum(amount) as TotalSum from incomes group by income_category_assigned_to_user_id
 
 */
class StatsModel extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
    
    public function getIncomeTotalSum($incomesPeroid)
    {
        /*$sql = 'SELECT income_category_assigned_to_user_id, sum(amount) as TotalSum FROM incomes WHERE user_id = :id group by income_category_assigned_to_user_id';
*/   

        $sql = 'SELECT 
                incomes_category_assigned_to_users.name as income_name,
                incomes.income_category_assigned_to_user_id, 
                sum(incomes.amount) as TotalSum 
                FROM incomes, incomes_category_assigned_to_users
                WHERE incomes.user_id = :id 
                AND incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id 
                AND incomes.date_of_income >= :peroidFor
                AND incomes.date_of_income <= :peroidTo
                group by incomes.income_category_assigned_to_user_id';


        $db = static::getDB(); 
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->bindValue(':peroidFor', $incomesPeroid['for'], PDO::PARAM_STR);
        $stmt->bindValue(':peroidTo', $incomesPeroid['to'], PDO::PARAM_STR);

        //$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class()); // zamieni wektor na obiekt

        $stmt->execute();

        if ($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

    }

    public function getExpenseTotalSum($expensesPeroid)
    {
        /*$sql = 'SELECT income_category_assigned_to_user_id, sum(amount) as TotalSum FROM incomes WHERE user_id = :id group by income_category_assigned_to_user_id';
*/   

        $sql = 'SELECT 
                expenses_category_assigned_to_users.name as expense_name,
                expenses.expense_category_assigned_to_user_id, 
                sum(expenses.amount) as TotalSum 
                FROM expenses, expenses_category_assigned_to_users
                WHERE expenses.user_id = :id 
                AND expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id 
                AND expenses.date_of_expense >= :peroidFor
                AND expenses.date_of_expense <= :peroidTo
                group by expenses.expense_category_assigned_to_user_id';


        $db = static::getDB(); 
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->bindValue(':peroidFor', $expensesPeroid['for'], PDO::PARAM_STR);
        $stmt->bindValue(':peroidTo', $expensesPeroid['to'], PDO::PARAM_STR);

        //$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class()); // zamieni wektor na obiekt

        $stmt->execute();

        if ($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

    }
        
}

