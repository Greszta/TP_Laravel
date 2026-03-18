<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::select()->orderby('created_at', 'desc')->paginate(4);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_fr' => 'nullable',
            'content_en' => 'required',
            'content_fr' => 'nullable',
        ]);

        $title = array_filter([
            'en' => $request->title_en,
            'fr' => $request->title_fr,
        ]);

        $content = array_filter([
            'en' => $request->content_en,
            'fr' => $request->content_fr,
        ]);

        $article = Article::create([
            'title' => $title,
            'content' => $content,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
         if ($article->user_id !== auth()->id()) {
        abort(403);
        }

        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
    
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }
    
        $request->validate([
            'title_en' => 'required',
            'content_en' => 'required',
            'title_fr' => 'nullable',
            'content_fr' => 'nullable',
        ]);
    
        $title = array_filter([
            'en' => $request->title_en,
            'fr' => $request->title_fr,
        ]);
        $content = array_filter([
            'en' => $request->content_en,
            'fr' => $request->content_fr,
        ]);
          $article->update([
            'title' => $title,
            'content' => $content
        ]);
        return redirect()->route('articles.index')->with('success', 'Article edit successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
        abort(403);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès');
    }
}
