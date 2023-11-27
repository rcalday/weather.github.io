<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\CustomScalarType;

class TypeWeather extends GraphQLType
{
    protected $attributes = [
        'name' => 'TypeWeather',
        'description' => 'A type of response for weather api'
    ];

    public function fields(): array
    {
        return [
            'weather' => [
                'type' => new CustomScalarType([
                    'name' => 'weather_details',
                    'serialize' => function($value){
                        return $value;
                    }
                ]),
            ],
            'main' => [
                'type' => new CustomScalarType([
                    'name' => 'temp_details',
                    'serialize' => function($value){
                        return $value;
                    }
                ]),
            ],
        ];
    }
}
