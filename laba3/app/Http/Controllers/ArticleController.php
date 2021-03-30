<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get articles
        if ($request->filtering === 'asc') {
            $articles = Article::orderBy('created_at', 'asc')->paginate(5);
        } else {
            $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        }

        foreach ($articles as &$article) {
            $user = User::find($article->user_id);
            $article['created_by'] = $user->email;

        }
        // Return collection of articles as a resource
        return ArticleResource::collection($articles);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = null;
        if ($request->isMethod('put')) {
            $user = $this->isUserHasPermissions($request->input('article_id'), $request->cookie('token'));

            if ($user == null) {
                return response()->json(['status' => "Can't update that. No permissions"],401);
            }

            $article = Article::findOrFail($request->article_id);
        } else {
            $article = new Article;
            $user = $this->getUserByToken($request->cookie('token'));
            $article->user_id = $user->id;
        }


        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if($article->save()) {
            return new ArticleResource($article);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get article
        $article = Article::findOrFail($id);

        // Return single article as a resource
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $user = $this->isUserHasPermissions($id, $request->cookie('token'));

        if ($user == null) {
            return response()->json(['status' => "Can't delete that. No permissions"],401);
        }

        $article = Article::find($id)->where('user_id', $user->id);

        if($article->delete()) {
            return new ArticleResource($article);
        }
    }


    private function isUserHasPermissions($articleId, $token) {
        $user = $this->getUserByToken($token);
        $article = Article::find($articleId)->where('user_id', $user->id)->first();

        if ($article) {
            return $user;
        } else {
            return null;
        }
    }

    private function getUserByToken($token) {
        $decodedJWT = JWT::decode($token, env('APP_KEY', "key"), array('HS256'));
        $user = User::where('email', $decodedJWT->email)->first();

        return $user;
    }
}
