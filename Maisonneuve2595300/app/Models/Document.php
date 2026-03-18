<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'filename',
        'user_id'
    ];

    protected $casts = [
        'title' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
