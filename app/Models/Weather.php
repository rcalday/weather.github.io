<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use GuzzleHttp\Client;
use Log;

class Weather extends Eloquent
{
    public function currentWeather($place)
    {
        $client = new Client();
        $api_url = "https://api.openweathermap.org/data/2.5/weather?appid=8b6f5ac410604332afe4661fff143727&q=".$place.",JP";
        $res = $client->getAsync($api_url,)->then(function($data)
        {
            $response = new \StdClass();
            $response->error = false;
            $response->message = "";
            $response->_weather_data = json_decode($data->getBody()->getContents());
            return $response;
        },function($e){
            $response = new \StdClass();
            $response->error = true;
            $response->message = $e->getMessage();
            return $response;
        });
        $response = $res->wait();
        return $response;
    }
}
