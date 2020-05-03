<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getAllArticles()
    {
        return Article::all();
    }

    public function getArticle(Article $article)
    {
        return $article;
    }

    public function createArticle(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $user = $request->user();

        $article = new Article();
        $article->title = $title;
        $article->content = $content;
        $article->user_id = $user->id;
        $article->save();

        return $article;
    }

    public function updateArticle(Request $request, Article $article)
    {
        $user = $request->user();
        if ($user->id != $article->user_id) {
            return response()->json(["error" => "No access!"], 400);
        } else {
            $title = $request->title;
            $content = $request->content;
            $article->title = $title;
            $article->content = $content;
            $article->save();

            return $article;
        }
    }

    public function deleteArticle(Request $request, Article $article)
    {
        $user = $request->user();
        if ($user->id != $article->user_id) {
            return response()->json(["error" => "No access!"], 400);
        } else {
            $article->delete();
            return response()->json(["success" => "Deleted!"], 200);
        }
    }
}
