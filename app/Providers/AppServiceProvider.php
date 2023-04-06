<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Support\ServiceProvider;
use App\Contracts\{ResponseContract, JsonPlaceholderContract};
use App\Services\JsonPlaceholderService;
use App\Http\APIBaseResponder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        \Illuminate\Support\Carbon::setLocale(config('app.locale'));
        $this->app->singleton(ResponseContract::class, APIBaseResponder::class);
        $this->app->singleton(JsonPlaceholderContract::class, JsonPlaceholderService::class);
    }
    /**
     * Bootstrap any application services.
     *
     * @param UrlGenerator $url
     */
    public function boot(UrlGenerator $url): void
    {
        if (!$this->app->isLocal() && !$this->app->runningUnitTests()) {
            $url->forceScheme('https');
        }
        ParallelTesting::setUpProcess(function (int $token) {
            Artisan::call('migrate:fresh', ['--env' => 'testing']);
        });
    }
}
