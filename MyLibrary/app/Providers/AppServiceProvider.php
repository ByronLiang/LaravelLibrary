<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton('leancloud', \App\Services\LeancloudService::class);

        // $this->app->singleton('qiniu', \App\Services\QiniuService::class);

        // $this->app->singleton('wechat', \App\Services\WechatService::class);
    }
}
