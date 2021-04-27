<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Category;

class PostEditMutation extends Mutation
{
    protected $attributes = [
        'name' => 'editPost'
    ];


    public function rules(array $args = [])
    {
        return [
            'id' => [
                'sometimes',
            ],

            'title' => [
                'required',
                'max:50'
            ],

            'description' => [
                ' required',
            ],

            'body' => [
                'required',
                'max:1000'
            ],

            'category' => [
                'required'
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
                'type' =>  Type::int()
            ],
            'title' => [
                'name' => 'title',
                'type' =>  Type::nonNull(Type::string())
            ],
            'description' => [
                'name' => 'description',
                'type' =>  Type::nonNull(Type::string())
            ],

            'body' => [
                'name' => 'body',
                'type' =>  Type::nonNull(Type::string())
            ],

            'category' => [
                'name' => 'category',
                'type' =>  Type::nonNull(Type::string())
            ],

        ];
    }

    public function resolve($root, $args)
    {
        $category = Category::where('name', $args['category'])->first();
        $args['category_id'] = $category->id;
        $user = User::where('id', $_SESSION['user_id'])->first();
        $post = Post::where('id', $args['id'])->first();

        if ($user  == null){
            abort(401,"Unauthorized");
        }


        if ($user->id !== $post->user_id){
            abort(401,"Unauthorized");
        }


        if ($post->post_id !== $user->id)
        $post->fill($args);
        $post->save();

        return $post;
    }
}