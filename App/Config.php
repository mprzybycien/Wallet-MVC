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
    const MAILGUN_API_KEY = "80ef39c59a21caf073d2dccf5e8207f8-29561299-83635468";
    
      /**
     * Mailgun API URL
     *
     * @var string
     */
    const MAILGUN_API_URL = "https://api.mailgun.net/v3/sandboxf55f384e1ef74782a578a83987955db4.mailgun.org";

    /**
     * Mailgun domain
     *
     * @var string
     */
    const MAILGUN_DOMAIN = "sandboxf55f384e1ef74782a578a83987955db4.mailgun.org";
    
}
