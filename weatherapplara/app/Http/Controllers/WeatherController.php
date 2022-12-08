<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\WeatherHistory;

class WeatherController extends Controller
{

    // Storing weather data from API
    public function storeForecast(Request $request)
    {
        $data = [];
        $api_key = '4c7f1f68689243332f5672f3f5d973e0';

        $cities = City::get();

        foreach ($cities as $city) {
            //https://api.openweathermap.org/data/2.5/weather?lat=24.453884&lon=54.377342&appid=4c7f1f68689243332f5672f3f5d973e0&units=metric

            // We are using CURL to get recent weather forecast
            $googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?lat=" . $city->lat . "&lon=" . $city->lon . "&lang=en&units=metric&APPID=" . $api_key;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);

            curl_close($ch);
            $get = json_decode($response);

            $mainData = $get->main;
            $time = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now(), 'UTC')
                ->setTimezone('Asia/Dhaka');

            $data[]= [
                'city' => $city->city,
                'coordinates' => json_encode($get->coord),
                'weather_condition' => $get->weather[0]->main,
                'temperature' => $mainData->temp,
                'feels_like' => $mainData->feels_like,
                'humidity' => $mainData->humidity,
                'speed' => $get->wind->speed,
                'created_at' => $time,
                'updated_at' => $time,
            ];
//            WeatherHistory::create($data);
            $currentTime = time();
        }
        if($data){
            WeatherHistory::insert($data);
        }
//        return $data;

    }
}
