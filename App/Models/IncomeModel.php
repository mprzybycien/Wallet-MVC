<?php

namespace App\Models;

use PDO;
use \Core\View;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class IncomeModel extends \Core\Model
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
            
        $sql = 'INSERT INTO incomes (user_id,   income_category_assigned_to_user_id, amount, date_of_income, income_comment)
                    VALUES (:user_id, :category, :amount, :date_of_income, :comment)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':category', $categoryId[0], PDO::PARAM_INT);
        $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
        $stmt->bindValue(':date_of_income', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);

        return $stmt->execute();
        } else return false;
    }

    public static function findCategoryId($category, $user_id)
    {
        $sql = 'SELECT id FROM incomes_category_assigned_to_users WHERE user_id = :id AND name = :category';

        $db = static::getDB();

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function validate()
    {
       // Amount
       if (filter_var($this->amount, FILTER_VALIDATE_FLOAT) === false) {
           $this->errors[] = 'Amount must be floating point value';
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

    public function getIncomes($incomesPeroid)
    {

        $sql = 'SELECT incomes_category_assigned_to_users.name AS incomes_name, 
                incomes.id, 
                incomes.amount, 
                incomes.date_of_income, 
                incomes.income_comment            
        
        FROM incomes, incomes_category_assigned_to_users 
        WHERE incomes.user_id = :id 
        AND incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id 
        AND incomes.date_of_income >= :peroidFor
        AND incomes.date_of_income <= :peroidTo

        ORDER BY incomes.date_of_income DESC';



        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':peroidFor', $incomesPeroid['for'], PDO::PARAM_STR);
        $stmt->bindValue(':peroidTo', $incomesPeroid['to'], PDO::PARAM_STR);

        $stmt->execute();
        
        if ($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
        

    }

    public function findByID($id)
    {
        $sql = 'SELECT * FROM incomes WHERE id = :id';

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
        $category_id = $this->findByName($this->category);

        if (empty($this->errors)) {
            $sql = 'UPDATE incomes 
                    SET income_category_assigned_to_user_id = :category_id,
                    amount = :amount,
                    date_of_income = :income_date,
                    income_comment = :comment
                    WHERE id = :id';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':id', $this->incomeId, PDO::PARAM_INT);
            $stmt->bindValue(':category_id', $category_id->id, PDO::PARAM_INT);
            $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
            $stmt->bindValue(':income_date', $this->income_date, PDO::PARAM_STR);
            $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);
            
            return $stmt->execute();
            }
            return false;
    }

    public function findByName($name)
    {
        $sql = 'SELECT * FROM incomes_category_assigned_to_users 
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
        $sql = 'DELETE FROM incomes 
                WHERE id = :id' ;
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $this->incomeId, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }


}
