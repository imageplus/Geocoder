<?php

namespace Imageplus\Geocoder;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config' => config_path('image-plus-geocoder'),
        ]);
        App::bind('geocode', function()
        {
            return new Geocode;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/geocoder.php', 'image-plus-geocoder'
        );
    }


}
