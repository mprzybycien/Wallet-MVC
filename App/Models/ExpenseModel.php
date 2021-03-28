<?php

namespace App\Models;

use PDO;
use \Core\View;

/**
 * Example Expense model
 *
 * PHP version 7.0
 */
class ExpenseModel extends \Core\Model
{

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
    
    public function save()
    {

        $this->validate();

        if(empty($this->errors)) {    
        $user_id = $_SESSION['user_id'];
        $categoryId = static::findCategoryId($this->category, $user_id);
        $methodId = static::findMethodId($this->method, $user_id);
            
        $sql = 'INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment)
                    VALUES (:user_id, :category, :method, :amount, :date_of_income, :comment)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':category', $categoryId[0], PDO::PARAM_INT);
        $stmt->bindValue(':method', $methodId[0], PDO::PARAM_INT);
        $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
        $stmt->bindValue(':date_of_income', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);

        return $stmt->execute();
        } else return false;
    }

    public static function findCategoryId($category, $user_id)
    {
        $sql = 'SELECT id FROM expenses_category_assigned_to_users WHERE user_id = :id AND name = :category';

        $db = static::getDB();

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function findMethodId($method, $user_id)
    {
        $sql = 'SELECT id FROM payment_methods_assigned_to_users WHERE user_id = :id AND name = :method';

        $db = static::getDB();

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':method', $method, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function validate()
    {
       // Amount
       if (filter_var($this->amount, FILTER_VALIDATE_FLOAT) === false) {
           $this->errors[] = 'Amount must be floating poin value';
       }

       if (strlen($this->comment) > 40) {
               $this->errors[] = 'The comment cannot be longer than 40 characters';
       }
    }
}
