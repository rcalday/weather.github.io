<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Location;
use Log;

class QueryLocation extends Query
{
    protected $attributes = [
        'name' => 'QueryLocation',
        'description' => 'Queries for weather request',
    ];

    public function args(): array
    {
        return [
            'location' => ['type' => GraphQL::type('input_fields')],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('type_response');
    }

    public function resolve($root, $args)
    {
        $args = $args['location'];
        $error = false;
        $message = '';
        $model_location = new Location();
        if($args['action_type'] == "get_location"){
            $category = isset($args['category']) ? $args['category'] : "";
            $search = isset($args['place_search']) ? $args['place_search'] : "";
            $responseObj = $model_location->currentLocation($args['destination'],$category,$search);
            return $responseObj;
        }
        $responseObj = new \StdClass();
        $responseObj->error = $error;
        $responseObj->message = $message;
        return $responseObj;
    }
}
