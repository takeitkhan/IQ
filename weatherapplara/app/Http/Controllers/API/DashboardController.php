<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WeatherHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function getTemperature(Request $request)
    {
        $weather_history = WeatherHistory::query();

        $weather_history = $weather_history->selectRaw('*, count(*), AVG(temperature) AS tempo, HOUR(`created_at`) AS DATE_HOUR');
        $weather_history = $weather_history->whereRaw('city = "Abu Dhabi"');
        #$weather_history = $weather_history->where('created_at', '>=', Carbon::now()->subHour(24)->toDateTimeString());
        $weather_history = $weather_history->orderBy('created_at', 'ASC');
        $weather_history = $weather_history->groupBy(
            DB::raw('date(created_at), HOUR(`created_at`), FLOOR( MINUTE(`created_at`) / 120)')
        )->get();


        /**
         * SELECT *, count(*), AVG(temperature)
         * FROM weather_history
         * WHERE city = 'Abu Dhabi'
         * GROUP BY
         *
         * DATE(`created_at`),
         * HOUR(`created_at`),
         * FLOOR( MINUTE(`created_at`) / 120);
         */

        $prepare_data = [];
//        dd($weather_history);
        foreach ($weather_history as $wh) {

            $prepare_data[] = [
                'hour' => strval($wh->DATE_HOUR),
                'temperature' => $wh->tempo
            ];
        }
        return $prepare_data;
    }


    public function getWind(Request $request)
    {
        $weather_history = WeatherHistory::query();

        $weather_history = $weather_history->selectRaw('*, count(*), AVG(temperature) AS tempo, HOUR(`created_at`) AS DATE_HOUR');
        $weather_history = $weather_history->whereRaw('city = "Abu Dhabi"');
        #$weather_history = $weather_history->where('created_at', '>=', Carbon::now()->subHour(24)->toDateTimeString());
        $weather_history = $weather_history->orderBy('created_at', 'ASC');
        $weather_history = $weather_history->groupBy(
            DB::raw('date(created_at), HOUR(`created_at`), FLOOR( MINUTE(`created_at`) / 120)')
        )->get();

        $prepare_data = [];
        foreach ($weather_history as $wh) {

            $prepare_data[] = [
                'hour' => strval($wh->DATE_HOUR),
                'speed' => $wh->speed
            ];
        }
        return [
            'average_speed' => $weather_history->average('speed') . 'km/h',
            'all' => $prepare_data,
        ];
    }


    public function getHumidity(Request $request)
    {
        $weather_history = WeatherHistory::query();

        $weather_history = $weather_history->selectRaw('*, count(*), AVG(temperature) AS tempo, HOUR(`created_at`) AS DATE_HOUR');
        $weather_history = $weather_history->whereRaw('city = "Abu Dhabi"');
        #$weather_history = $weather_history->where('created_at', '>=', Carbon::now()->subHour(24)->toDateTimeString());
        $weather_history = $weather_history->orderBy('created_at', 'ASC');
        $weather_history = $weather_history->groupBy(
            DB::raw('date(created_at), HOUR(`created_at`), FLOOR( MINUTE(`created_at`) / 120)')
        )->get();

        $prepare_data = [];
        foreach ($weather_history as $wh) {

            $prepare_data[] = [
                'hour' => strval($wh->DATE_HOUR),
                'humidity' => $wh->humidity
            ];
        }
        return $prepare_data;
    }

    public function getWeatherReports(Request $request)
    {
        $data = WeatherHistory::leftjoin('cities', 'cities.city', 'weather_history.city')
            ->select('weather_history.*', 'cities.country')
            ->orderBy('id', 'DESC')->groupBy('city')->get();
        return $data;
    }

    public function getWeatherHisty(Request $request)
    {
        $data = WeatherHistory::orderBy('id', 'ASC')->take(300)->get();
        return response()->json($data);
    }
}





//$weather_history = $weather_history->selectRaw('*, avg(temperature) as tempo, DATE_ADD(date(created_at), INTERVAL EXTRACT(HOUR FROM created_at) HOUR) as DATE_HOUR');
//$weather_history = $weather_history->whereRaw('city = "Abu Dhabi"');
//$weather_history = $weather_history->where('created_at', '>=', Carbon::now()->subHour(24)->toDateTimeString());
//$weather_history = $weather_history->orderBy('created_at', 'ASC');
//$weather_history = $weather_history->groupBy(
//    DB::raw('date(created_at), EXTRACT(HOUR FROM created_at)')
//)->get();
