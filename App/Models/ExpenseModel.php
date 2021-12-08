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

    public function getPeroid()
    {
        if($this->peroid == 1) {
            $dates['for'] = date('Y-m-00');
            $dates['to'] = date("Y-m-t"); //last day of month
            //$dates['to'] = date('Y-m-d');

        } else if  ($this->peroid == 2) {
            $dates['for'] = date("Y-m-d", strtotime("first day of previous month"));
            $dates['to'] = date("Y-m-d", strtotime("last day of previous month"));

        } else if ($this->peroid == 3) {

            if($this->date1 > $this->date2){
                $dates['for'] = $this->date2;
                $dates['to'] = $this->date1;

            } else {         
                $dates['for'] = $this->date1;
                $dates['to'] = $this->date2;
            }
        } 
        return $dates;
    }

    public function getExpenses($expensesPeroid)
    {

        $sql = 'SELECT 
                expenses_category_assigned_to_users.name AS expenses_name, 
                payment_methods_assigned_to_users.name AS method_name, 
                expenses.id, 
                expenses.amount, 
                expenses.date_of_expense, 
                expenses.expense_comment            
        
        FROM expenses, expenses_category_assigned_to_users, payment_methods_assigned_to_users 
        WHERE expenses.user_id = :id 
        AND expenses.payment_method_assigned_to_user_id = payment_methods_assigned_to_users.id 
        AND expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id
        AND expenses.date_of_expense >= :peroidFor
        AND expenses.date_of_expense <= :peroidTo

        ORDER BY expenses.date_of_expense DESC';



        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':peroidFor', $expensesPeroid['for'], PDO::PARAM_STR);
        $stmt->bindValue(':peroidTo', $expensesPeroid['to'], PDO::PARAM_STR);

        $stmt->execute();
        if ($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function findByID($id)
    {
        $sql = 'SELECT * FROM expenses WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public function edit()
    {   
        $this->validate();
        $category_id = $this->findCatByName($this->category);
        $method_id = $this->findMethodByName($this->method);

        if (empty($this->errors)) {
            $sql = 'UPDATE expenses 
                    SET expense_category_assigned_to_user_id = :category_id,
                    payment_method_assigned_to_user_id = :method_id,
                    amount = :amount,
                    date_of_expense = :expense_date,
                    expense_comment = :comment
                    WHERE id = :id';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':id', $this->expenseId, PDO::PARAM_INT);
            $stmt->bindValue(':category_id', $category_id->id, PDO::PARAM_INT);
            $stmt->bindValue(':method_id', $method_id->id, PDO::PARAM_INT);
            $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
            $stmt->bindValue(':expense_date', $this->expense_date, PDO::PARAM_STR);
            $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);
            
            return $stmt->execute();
            }
            return false;
    }

    public function findCatByName($name)
    {
        $sql = 'SELECT * FROM expenses_category_assigned_to_users 
                WHERE user_id = :id
                AND name = :name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

        public function findMethodByName($name)
    {
        $sql = 'SELECT * FROM payment_methods_assigned_to_users 
                WHERE user_id = :id
                AND name = :name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }



    public function delete()
    {   
        $sql = 'DELETE FROM expenses 
                WHERE id = :id' ;
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $this->expenseId, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }


    public static function totalExpenseByCat($expenseCat, $value, $date)
    {
        $user_id = $_SESSION['user_id'];
        $expenseCatId = ExpenseModel::findCategoryId($expenseCat, $user_id);

        $start = date('Y-m-01', strtotime($date));
        $end = date('Y-m-t', strtotime($date));

        $sql = 'SELECT 
                sum(expenses.amount) as Sum 
                FROM expenses
                WHERE user_id = :id 
                AND expense_category_assigned_to_user_id = :expenseCatId
                AND date_of_expense >= :peroidFor
                AND date_of_expense <= :peroidTo';


        $db = static::getDB(); 
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $user_id, PDO::PARAM_STR);
        $stmt->bindValue(':expenseCatId', $expenseCatId[0], PDO::PARAM_STR);
        $stmt->bindValue(':peroidFor', $start, PDO::PARAM_STR);
        $stmt->bindValue(':peroidTo', $end, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $totalExpense = $row['Sum'] + $value;
        }   

        if($totalExpense) return $totalExpense;
        else return 0;
    }

}
