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
 */
class Currency extends \Core\Model
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
    
    public function getCurrencies()
    {
        
        $sql = 'SELECT * FROM currencies';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


}

