<?php

namespace App;


use App\Config;
use Mailgun\Mailgun;


/**
 * Unique random tokens
 *
 * PHP version 7.0
 */

class Mail
{
    public static function send($to, $subject, $text, $html)
    {
            // First, instantiate the SDK with your API credentials
            $mg = Mailgun::create(Config::MAILGUN_API_KEY); // For US servers
            //$mg = Mailgun::create(Config::MAILGUN_API_KEY, Config::MAILGUN_API_URL); // For EU servers

            // Now, compose and send your message.
            // $mg->messages()->send($domain, $params);
            $mg->messages()->send(Config::MAILGUN_DOMAIN, [
                    'from'	=> 'jozek@mateuszprzybycien.pl',
                    'to'	=> $to,
                    'subject' => $subject,
                    'text'	=> $text,
                    'html' => $html]);
    }

    public static function sender()
    {
        $from  = "From: wallet@mateuszprzybycien.pl \r\n";
        $from .= 'MIME-Version: 1.0'."\r\n";
        $from .= 'Content-type: text/html; charset=iso-8859-2'."\r\n";

        return $from;
    }

}

