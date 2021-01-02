<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
     {

         $mailFrom = option('mail_from', env('MAIL_FROM_ADDRESS', 'hello@example.com'));
         $mailMailer = option('mail_mailer','smtp');
         $mailHost = option('mail_host', 'smtp.mailgun.org');
         $mailPort = option('mail_port', 587);
         $mailEncryption = option('mail_encryption', 'tls');
         $mailUserName = option('mail_username', '');
         $mailPassword = option('mail_password', '');
         $sesKey = option('ses_key', '');
         $sesSecret = option('ses_secret', '');
         $sesRegion = option('ses_region', '');


        config([
            'mail.from.address'=>$mailFrom,
            'mail.mailer'=> $mailMailer,
            'mail.mailers' => [
                'smtp'=>[
                    'transport'=>$mailMailer,
                    'host' => $mailHost,
                    'port' => $mailPort,
                    'encryption' => $mailEncryption,
                    'username' => $mailUserName,
                    'password' => $mailPassword,
                ],
                'ses'=>[
                    'key' => $sesKey,
                    'secret' => $sesSecret,
                    'region' => $sesRegion
                ]
            ],
            'services.ses'=>[
                'key' => $sesKey,
                'secret' => $sesSecret,
                'region' => $sesRegion,
            ]
        ]);
    }
}
