<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    private array $staticUrls = [
        '/'           => ['priority' => 1.0, 'freq' => Url::CHANGE_FREQUENCY_DAILY],
        '/about-us'   => ['priority' => 0.8, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
        '/contact-us' => ['priority' => 0.5, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
        '/apply-now'  => ['priority' => 0.7, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
    ];

    public function generate(Request $request)
    {
        $appUrl = config('app.url');
        $sitemap = Sitemap::create();

        foreach ($this->staticUrls as $path => $meta) {
            $sitemap->add(
                Url::create($appUrl . $path)
                    ->setPriority($meta['priority'])
                    ->setChangeFrequency($meta['freq'])
                    ->setLastModificationDate(Carbon::now())
            );
        }

        foreach (\App\Models\Service::all() as $service) {
            $sitemap->add(
                Url::create("{$appUrl}/services/details/{$service->slug}")
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setLastModificationDate($service->updated_at)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}