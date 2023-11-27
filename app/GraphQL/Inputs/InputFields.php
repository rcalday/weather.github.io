<?php

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;
use GraphQL\Type\Definition\CustomScalarType;

class InputFields extends InputType
{
    protected $attributes = [
        'name' => 'InputFields',
        'description' => 'Input fields for weather queries or mutation',
    ];

    public function fields(): array
    {
        return [
            'action_type' => [
                'type' => Type::string(),
                'description' => 'type of action to query/mutation',
            ],
            'destination' => [
                'type' => Type::string(),
                'description' => 'dynamic input for checking places'
            ],
            'category' => [
                'type' => Type::string(),
                'description' => 'dynamic input for category of places'
            ],
            'place_search' => [
                'type' => Type::string(),
                'description' => 'dynamic input for place to check'
            ],
        ];
    }
}
