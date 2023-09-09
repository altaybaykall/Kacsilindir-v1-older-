<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Helper
{
    public static function getfuelprice()
    {

        $data = Cache::remember('fuelprices',30000, function (){
            $response =Http::withHeaders([
                'Content-Type' => 'application/json',

            ])->get('https://api.opet.com.tr/api/fuelprices/prices?ProvinceCode=934&IncludeAllProducts=true');

            $data = json_decode($response , true);

            $istanbuldizel = $data[0]['prices'][3]['amount'];
            $istanbulbenzin = $data[0]['prices'][0]['amount'];

            return [
                'istanbulbenzin' => $istanbulbenzin,
                'istanbuldizel' => $istanbuldizel,
            ];
        });


        return [
            'istanbulbenzin' => $data['istanbulbenzin'],
            'istanbuldizel' => $data['istanbuldizel'],
        ];
    }
}

