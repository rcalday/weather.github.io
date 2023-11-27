<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\CustomScalarType;

class TypeLocation extends GraphQLType
{
    protected $attributes = [
        'name' => 'TypeLocation',
        'description' => 'A type of response for four square api'
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
            ],
            'categories' => [
                'type' => new CustomScalarType([
                    'name' => 'place_category',
                    'serialize' => function($value){
                        return $value;
                    }
                ]),
            ],
            'location' => [
                'type' => new CustomScalarType([
                    'name' => 'place_location',
                    'serialize' => function($value){
                        return $value;
                    }
                ]),
            ],
        ];
    }
}
