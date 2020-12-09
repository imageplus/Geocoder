<?php


namespace Imageplus\Geocoder\Facades;

use Illuminate\Support\Facades\Facade;

class Geocode extends Facade
{
    protected static function getFacadeAccessor() {
        return 'geocode';
    }
}