<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'wallet_mvc';
    //const DB_NAME = 'mateus10_php_mvc';
    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';
    //const DB_USER = '   mateus10_walletAdmin';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '';
    //const DB_PASSWORD = 'wallet1234!';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
    



    /**
     * Secret key for hashing
     * @var boolean
     */
    /*
    const SECRET_KEY = '8qB4wKj7DMPzgqGsYdyeN7hJ5fDlG67x';
    
        /**
     * Mailgun API key
     *
     * @var string
     */
    const MAILGUN_API_KEY = "";
    
      /**
     * Mailgun API URL
     *
     * @var string
     */
    const MAILGUN_API_URL = "";

    /**
     * Mailgun domain
     *
     * @var string
     */
    const MAILGUN_DOMAIN = "";
    
}
