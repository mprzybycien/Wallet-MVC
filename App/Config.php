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

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'mvcuser';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'secret';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
    
    /**
     * Secret key for hashing
     * @var boolean
     */
    
    const SECRET_KEY = '8qB4wKj7DMPzgqGsYdyeN7hJ5fDlG67x';
    
        /**
     * Mailgun API key
     *
     * @var string
     */
    const MAILGUN_API_KEY = "0cf7ca3e418fae52ce7579e794e2206a-e49cc42c-a52c5826";
    
      /**
     * Mailgun API URL
     *
     * @var string
     */
    const MAILGUN_API_URL = "https://api.mailgun.net/v3/sandbox7d0b9ab6926941aab436ad5e0a94dca8.mailgun.org";

    /**
     * Mailgun domain
     *
     * @var string
     */
    const MAILGUN_DOMAIN = "sandbox7d0b9ab6926941aab436ad5e0a94dca8.mailgun.org";
    
}
