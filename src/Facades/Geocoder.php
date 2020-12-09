<?php


namespace Imageplus\Geocoder\Facades;

use Illuminate\Support\Facades\Facade;

class Geocoder extends Facade
{
    protected static function getFacadeAccessor() {
        return 'geocode';
    }
}