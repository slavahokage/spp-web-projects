<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Category;

class PostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'addPost'
    ];


    public function rules(array $args = [])
    {
        return [

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
        $args['user_id'] = $_SESSION['user_id'];
        //$args['user_id'] = session('user_id');
        //$args['user_id'] = 1;
        //$args['category_id'] = 1;
        $post = new Post();

        $post->fill($args);
        $post->save();

        return $post;
    }
}