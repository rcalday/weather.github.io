<?php

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\CustomScalarType;

class TypeResponse extends GraphQLType
{
    protected $attributes = [
        'name' => 'TypeResponse',
        'description' => 'corresponding variables to a given field or response'
    ];

    public function fields(): array
    {
        return [
            'error' => [
                'type'=> Type::boolean(),
            ],
            'message' => [
                'type' => Type::string(),
            ],
            '_weather_data'=>[
                'type' => GraphQL::type('type_weather')
            ],
            '_location_data'=>[
                'type' => Type::listof(GraphQL::type('type_location'))
            ]
        ];
    }
}
