<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRegisterMutation extends Mutation
{
    protected $attributes = [
        'name' => 'userRegister'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }


    public function rules(array $args = [])
    {
        return [
            'email' => [
                'required',
            ],
            'password' => [
                'required',
            ],
            'name' => [
                'required',
            ],
        ];
    }

    public function args()
    {
        $args = [
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' =>  Type::nonNull(Type::string()),
            ],
        ];

        return $args;
    }

    public function resolve($root, $args)
    {
        $user = new User();
        $user->fill($args);
        $user->save();

        return $user;
    }
}