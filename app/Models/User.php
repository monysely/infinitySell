<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Review;
use App\Models\Article;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'github_id',
        'github_token',
        'github_refresh_token',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public static function usersCounter(){
        $counter = User::all()->count();
        return $counter;
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
