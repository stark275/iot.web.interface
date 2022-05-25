<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    // private $message;
    // private $receiver;
    private $username;
    private $password;
    private $name;
    private const URL = 'http://sms.eliajimmy.net/apisms.php?';



    public function __construct($name = null)
    {
        $this->username = config('sms.username');
        $this->password = config('sms.password');
        $this->name = ($name != null) ? $name : config('sms.name') ;
    }

    public static function getInstance($name = null)
    {
        return new SmsService($name);
    }

    public function buildURL($message, $receiver)
    {
        $url = self::URL;
        $url .= 'user='.$this->username;
        $url .= '&password='.$this->password;
        $url .= '&message='.$message;
        $url .= '&expediteur='.$this->name;
        $url .= '&telephone='.$receiver;

        return $url;
    }

    public function send($message, $receiver)
    {
        return  Http::get($this->buildURL($message, $receiver))->json();
    }




}

// http://sms.eliajimmy.net/apisms.php?user=username&password=password&message=message&expediteur=nomExpediteur&telephone=243+numero
