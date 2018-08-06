<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\BoxType;

class BoxTypeQuery extends Query
{
    protected $attributes = [
        'name' => 'Box type'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('BoxType'));
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return BoxType::where('id', $args['id'])->get();
        }

        return BoxType::all();
    }
}