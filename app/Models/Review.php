<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function reviewsCounter(){
        $reviews = Review::all()->count();
        return $reviews;
    }
}
