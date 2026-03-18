<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Http\Resources\ArticleResource;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    static public function articles() {
        $articles = self::all();
        $articlesR = ArticleResource::collection($articles)->resolve();
        $sorted = collect($articlesR)->sortBy('article')->values();
        return $sorted->all();
    }
}
