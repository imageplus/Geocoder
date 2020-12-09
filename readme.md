# Geocoding made simple - without all the clutter and complexity

A Laravel 5.X package providing simple wrappers over three postcode geocoding services

Here are a few short examples of what you can do:

```php
 $results = Geocoder::geocode($request->postcode,'googlemaps');
 $latitude = $results['lat'];
$longitude = $results['lng'];
```

## Documentation

TBC

Find yourself stuck using the package? Found a bug? Got a suggestion of additional providers to add Feel free to [create an issue on GitHub](https://github.com/imageplus/geocoder/issues), we'll try to address it as soon as possible.

If you've found a bug regarding security please mail [support@image-plus.co.uk](mailto:support@image-plus.co.uk).

## Installation

You can install this package via composer using this command:

```bash
composer require imageplus/geocoder
```

You will need to register the service provider the usual way.

```php
 'providers' => [

        /*
         * Package Service Providers...
         */
        Imageplus\Geocoder\GeocoderServiceProvider::class,

    ],
```

Autodiscovery TBC

You can publish required configuration files using

```bash
php artisan vendor:publish
```

Please then add API keys for the providers you wish to use to your .env file. They should be stored in the following format by default:

```bash
IMAGEGEO_PREFER=postcodeio
OPENCAGE_API_KEY=
GOOGLE_MAPS_API_KEY=
```

## Testing

TBC

## Who are we?

Image+ are a web and mobile app development agency based in Coventry, United Kingdom. 

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.