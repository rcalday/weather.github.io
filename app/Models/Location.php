<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use GuzzleHttp\Client;
use Log;

class Location extends Eloquent
{
    public function currentLocation($destination,$category,$place){
        $client = new Client();
        $api_url = "https://api.foursquare.com/v3/places/search?near=".$destination.",Japan&limit=5&open_now=true";
        if($category != ""){
            $api_url .= "&categories=".$category;
        }
        if($place != ""){
            $api_url .= "&query=".$place;
        }
        $headers = [
            'accept' => 'application/json',
            'Authorization' => 'fsq3dZ14JnZGKKad6Q0AU2GgFzGmgJd8B66fEpH3H9WRcbc=',
        ];
        $res = $client->getAsync($api_url,['headers'=>$headers])->then(function($data)
        {
            $response = new \StdClass();
            $response->error = false;
            $response->message = "";
            $response->_location_data = json_decode($data->getBody()->getContents())->results;
            return $response;
        },function($e)
        {
            $response = new \StdClass();
            $response->error = true;
            $response->message = $e->getMessage();
            return $response;
        });
        $response = $res->wait();
        return $response;
    }
}
