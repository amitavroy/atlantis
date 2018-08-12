<?php

namespace App\Services\SiteCheck;

use App\Events\SiteCheck\SiteIsDownevent;
use App\Events\SiteCheck\SiteIsNormalEvent;
use App\Events\SiteCheck\SiteIsSlowEvent;
use App\Site;
use App\SiteRecord;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Event;

class SiteCheck
{
    public static function handle()
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            self::checkSite($site);
        }
    }

    private static function checkSite($site)
    {
        $start = microtime(true);

        $client = new Client();
        $res = $client->request('GET', $site->url);

        $time = microtime(true) - $start;

        if ($res->getStatusCode() === 200) {
            self::saveSiteCheckEntry($site->id, $time);
            self::checkAverage($site->id);
        } else {
            Event::dispatch(new SiteIsDownevent($site));
        }
    }

    private static function saveSiteCheckEntry($id, $time)
    {
        SiteRecord::create([
            'site_id' => $id,
            'time' => $time,
        ]);
    }

    private static function checkAverage($id)
    {
        $site = Site::with('records')->where('id', $id)->first();
        $average = $site->records()->pluck('time')->avg();
        $site->avg_time = $average;
        $site->save();

        if ($average > ($site->avg_time + $site->avg_time * .3)) {
            Event::dispatch(new SiteIsSlowEvent($site));
        } else {
            Event::dispatch(new SiteIsNormalEvent($site));
//            Event::dispatch(new SiteIsSlowEvent($site));
        }
    }
}
