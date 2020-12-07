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
        config([
            'mail.from.address'=>option('mail_from', env('MAIL_FROM_ADDRESS', 'hello@example.com')),
            'mail.default' => option('mail_mailer','smtp'),
            'mail.driver'=> option('mail_mailer','smtp'),
            'mail.mailers.smtp' => [
                'transport' => 'smtp',
                'host' => option('mail_host', 'smtp.mailgun.org'),
                'port' => option('mail_port', 587),
                'encryption' => option('mail_encryption', 'tls'),
                'username' => option('mail_username'),
                'password' => option('mail_password'),
                'timeout' => null,
                'auth_mode' => null,
            ],
            'mail.mailers.ses' =>[
                'key' => option('ses_key', ''),
                'secret' => option('ses_secret', ''),
                'region' => option('ses_region', ''),
            ],
            'services.ses'=>[
                'key' => option('ses_key', ''),
                'secret' => option('ses_secret', ''),
                'region' => option('ses_region', ''),
            ]
        ]);
    }
}
