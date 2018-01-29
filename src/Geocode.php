<?php

namespace Imageplus\Geocoder;

use Illuminate\Support\Facades\Config;
use Zttp\Zttp;
class Geocode
{
    public function geocode($postcode,$preferred = null)
    {
        if($preferred == null)
        {
            $preferred = config('image-plus-geocoder.geocoder.preferred');
        }
        switch($preferred)
        {
            case 'postcodeio':
                $url = 'http://api.postcodes.io/postcodes/' . $postcode;
                return $this->postcodeio($url);
                break;
            case 'opencage':
                $apikey = config('image-plus-geocoder.geocoder.opencage');
                $url = 'https://api.opencagedata.com/geocode/v1/json?q='. $postcode . '&key=' . $apikey;
                return $this->opencage($url);
                break;
            case 'googlemaps':
                $apikey = config('image-plus-geocoder.geocoder.googlemaps');
                $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. $postcode . '&key=' . $apikey;
                return $this->googlemaps($url);
                break;
            default:
                throw new \Exception('No Provider Selected');
        }

    }

    private function postcodeio($url)
    {
        $data = $this->_get($url)->json();
        if($data['status'] == 200)
        {
            return [
                'lat' => round($data['result']['latitude'],config('image-plus-geocoder.geocoder.rounding',5)),
                'lng' => round($data['result']['longitude'],config('image-plus-geocoder.geocoder.rounding',5))
            ];
        }
        else{
            throw new \Exception('Geocoding Failed with error: ' . $data['status']);
        }


    }
    private function opencage($url)
    {
        $data = $this->_get($url)->json();
        if($data['status']['code'] == 200)
        {
            return [
                'lat' => round($data['results'][0]['geometry']['lat'],config('image-plus-geocoder.geocoder.rounding',5)),
                'lng' => round($data['results'][0]['geometry']['lng'],config('image-plus-geocoder.geocoder.rounding',5))
            ];
        }
        else{
            throw new \Exception('Geocoding Failed with error: ' . $data['status']['code'] . " " . $data['status']['message']);
        }
    }
    private function googlemaps($url)
    {
        $data = $this->_get($url)->json();
        if($data['status'] == "OVER_QUERY_LIMIT")
        {
            throw new \Exception('Geocoding Failed with error : 429 ' . "OVER_QUERY_LIMIT");
        }
        elseif($data['status'] == "ZERO_RESULTS")
        {
            throw new \Exception('Geocoding Failed with error : 404 ' . "ZERO_RESULTS");
        }
        elseif($data['status'] == "OK")
        {
            try{
                return [
                    'lat' => round($data['results'][0]['geometry']['location']['lat'],config('image-plus-geocoder.geocoder.rounding',5)),
                    'lng' => round($data['results'][0]['geometry']['location']['lng'],config('image-plus-geocoder.geocoder.rounding',5))
                ];
            }
            catch (\Exception $e) {
                throw new \Exception('Geocoding Failed with error: ' . $data['status']['code'] . " " . $data['status']['message']);
            }
        }
        else{
            throw new \Exception('Geocoding Failed with error: ' . $data['status']['code'] . " " . $data['status']['message']);
        }
    }
    private function _get($url)
    {
        try{
            $response = Zttp::get($url);
            return $response;
        }
        catch(\Exception $e)
        {
            throw new \Exception('The API key or response was not valid');
        }

    }

}