<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use App\Models\User;

class UserLoginMutation extends Mutation {

    protected $attributes = [
        'name'          => 'userLogin',
        'description'   => 'User Login using credentials',
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
        ];
    }

    public function args()
    {
        return [
            'email' => [
                'name'  => 'email',
                'type'  => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name'  => 'password',
                'type'  => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $userEmail = $args['email'];
        $userPassword = $args['password'];

        $user = User::where('email', $userEmail)->first();

        if ($user) {

            if (password_verify($userPassword, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                //session(['user_id' => $user->id]);
            } else {
                abort(401,"Unauthorized");
            }

        } else {
            abort(401,"Unauthorized");
        }

        return $user;
    }
}