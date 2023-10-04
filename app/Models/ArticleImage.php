<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleImage extends Model
{
    use HasFactory;

    protected $cast = [
        'labels' => 'array',
    ];

    public function article(){
        return $this->belongsTo(Article::class);
    }
}
