<?php

namespace App\Http\Traits;

use Facebook\Facebook;

trait FacebookTrait
{
    public $facebook_secrets;

    public function __construct(private Facebook $facebook)
    {
        $this->facebook_secrets = $this->facebookSecrets();
        $this->conf($this->facebookSecrets());
    }

    private function facebookSecrets()
    {
        return [
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v20.0',
            'enable_beta_mode' => true, // Enable beta mode for logging
        ];
    }

    private function conf($facebook_secrets): void
    {
        $this->fb = new Facebook($facebook_secrets);
    }

    public function fb()
    {
        return new Facebook($this->facebookSecrets());
    }
}
