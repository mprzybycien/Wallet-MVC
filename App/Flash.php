<?php

namespace App;

use \App\Models\User;

/**
 * Flash notifications
 *
 * PHP version 7.0
 */
class Flash
{
    /**
     * Success message type
     * @var string
     */
    const SUCCESS = 'success';

    /**
     * Information message type
     * @var string
     */
    const INFO = 'info';

    /**
     * Warning message type
     * @var string
     */
    const WARNING = 'warning';
    
    public static function addMessage($message, $type = 'success')
    {
        //torzenie wektora z powiadomieniami jak nie istnieje
        if(! isset($_SESSION['flash_notifications'])) {
            $_SESSION['flash_notifications'] = [];
        }
        
        // Nadpisanie wektora
        $_SESSION['flash_notifications'][] = [
            'body' => $message,
            'type' => $type
        ];
        
        
    }
    public static function getMessages()
    {
        if (isset($_SESSION['flash_notifications'])) {
            $messages = $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);
            
            return $messages;
        }
    }
    
}
