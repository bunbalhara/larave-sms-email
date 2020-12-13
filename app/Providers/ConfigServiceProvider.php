<?php

namespace App\Providers;

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
            'mail.default' => $mailMailer,
            'mail.driver'=> $mailMailer,
            'mail.mailers.smtp' => [
                'host' => $mailHost,
                'port' => $mailPort,
                'encryption' => $mailEncryption,
                'username' => $mailUserName,
                'password' => $mailPassword,
                'timeout' => null,
                'auth_mode' => null,
            ],
            'mail.mailers.ses' =>[
                'key' => $sesKey,
                'secret' => $sesSecret,
                'region' => $sesRegion,
            ],
            'services.ses'=>[
                'key' => $sesKey,
                'secret' => $sesSecret,
                'region' => $sesRegion,
            ]
        ]);
    }
}
