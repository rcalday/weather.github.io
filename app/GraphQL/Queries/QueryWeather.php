<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Weather;
use Log;

class QueryWeather extends Query
{
    protected $attributes = [
        'name' => 'QueryWeather',
        'description' => 'Queries for weather request',
    ];

    public function args(): array
    {
        return [
            'weather' => ['type' => GraphQL::type('input_fields')],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('type_response');
    }

    public function resolve($root, $args)
    {
        $args = $args['weather'];

        $error = false;
        $message = '';
        $model_weather = new Weather();
        if($args['action_type'] == "get_weather"){
            $responseObj = $model_weather->currentWeather($args['destination']);
            Log::info(print_r($responseObj,true));
            return $responseObj;
        }
        $responseObj = new \StdClass();
        $responseObj->error = $error;
        $responseObj->message = $message;
        // $responseObj->_data = null;

        return $responseObj;
    }
}
