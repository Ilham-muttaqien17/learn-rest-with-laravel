<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        return $this->default_response([
            'data' => Article::all(),
            'message' => 'Get article successfully!',
            'status' => 200
        ]);
    } 

    public function show($id) {
        $article = $this->get_article($id);
        if (!$article) {
            return $this->default_response([ 
                'data' => null, 
                'message' => 'Article not found!', 
                'status' => 404 
            ]);
        }
        return $this->default_response([
            'data' => $this->get_article($id),
            'message' => "Get article with id {$id} success",
            'status' => 200
        ]);
    }

    public function store(Request $request) {
        $article =  Article::create($request->all());
        if (!$article) {
            return $this->default_response([ 
                'data' => null, 
                'message' => 'Failed to create article!', 
                'status' => 400
            ]);
        }

        return $this->default_response([
            'data' => $article, 
            'message' => 'Create article successfully!', 
            'status' => 201
        ]);
    }

    public function update(Request $request, $id) {
        $article = $this->get_article($id);
        if (!$article) {
            return $this->default_response([ 
                'data' => null, 
                'message' => 'Article not found!', 
                'status' => 404 
            ]);
        }
        if ($article->update($request->all())) {
            return $this->default_response([ 
                'data' => $article, 
                'message' => 'Article updated successfully!', 
                'status' => 200
            ]);
        } 
    }

    public function delete(Request $request, $id) {
        $article = $this->get_article($id);
        if (!$article) {
            return $this->default_response([ 
                'data' => null, 
                'message' => 'Article not found!', 
                'status' => 404 
            ]);
        }
        $article->delete();
        return $this->default_response([
            'data' => $article,
            'message' => 'Deleted',
            'status' => 200
        ]);
    }

    private function get_article($id) {
        return Article::find($id);
    }
}
