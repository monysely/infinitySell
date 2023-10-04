<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ToBeRevisionedCounter extends Component
{
    public static function toBeRevisionedCount(){
        // return Article::where('is_accepted', null)->count();
        return DB::table('articles')->where('is_accepted', '=', null)->where('user_id', '!=', auth()->user()->id)->count();
    }
    public function render()
    {
        return view('livewire.to-be-revisioned-counter', ['articles'=>$this->toBeRevisionedCount()]);
    }
}
