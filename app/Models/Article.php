<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Revisor;
use App\Models\Category;
use App\Models\ourCategory;
use App\Models\ArticleImage;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'category_id',
        'title',
        'revisor_id'
    ];
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function articleImages(){
        return $this->hasMany(ArticleImage::class);
    }

    public function revisor(){
        return $this->belongsTo(Revisor::class);
    }

    // public static function toBeRevisionedCount(){
    //     return Article::where('is_accepted', null)->count();
    // }

    public function setAccepted($value){
        $this->is_accepted = $value;
        $this->revisor_id = auth()->user()->id;
        $this->save();
        return true;
    }

    public function toSearchableArray()
    {
        $category = $this->category;
        $array = [
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'category_id'=> $category,
        ];
        return $array;
    }

    public static function articlesCounter(){
        $counter = Article::where('is_accepted', true)->count();
        return $counter;
    }

    public function likes(){
        return $this->belongsToMany(Like::class);
    }

    public static function votes(){
        $articles = Article::all();
        $votes = [];
        foreach($articles as $key => $article){
            array_push($votes, $article->votants);
        }
        return array_sum($votes);
    }
}
