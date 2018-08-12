<?php

namespace App\Mail\SiteCheck;

use App\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SiteIsSlowMail extends Mailable
{
    use Queueable, SerializesModels;

    public $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function build()
    {
        return $this->from('reachme@amitavroy.com', 'Amitav Roy')
            ->subject("Site {$this->site->name} is running slow!")
            ->markdown('emails.sitecheck.slow')->with([
                'site' => $this->site,
            ]);
    }
}
