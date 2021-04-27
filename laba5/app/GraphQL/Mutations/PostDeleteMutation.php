<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;


class PostDeleteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deletePost'
    ];

    public function rules(array $args = [])
    {
        return [
            'id' => [
                'required'
            ],
            'result' => [
                'sometimes'
            ]
        ];
    }

    public function type()
    {
        return GraphQL::type('Post');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'result' => [
                'name' => 'result',
                'type' => Type::boolean()
            ]

        ];
    }

    public function resolve($root, $args)
    {
       $user = User::where('id', $_SESSION['user_id'])->first();

       if ($user == null) {
           abort(401,"Unauthorized");
       }


       $post = Post::where('id', $args['id'])->first();

       if ($user->id !== $post->user_id){
           abort(401,"Unauthorized");
       }

       $result = $post->delete();

       return $result;
    }
}