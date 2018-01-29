<?php


namespace Imageplus\Geocoder;

use Illuminate\Support\Facades\Facade;

class Imagegeo extends Facade
{
    protected static function getFacadeAccessor() {
        return 'geocode';
    }
}