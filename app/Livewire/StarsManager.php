<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\App;

class StarsManager extends Component
{
    public $id;
    public $message;

    public function render()
    {
        return view('livewire.stars-manager');
    }

    public function uno(){
        if(App::getLocale() == 'it'){
            $this->message = 'Grazie per la tua valutazione.';
        }elseif(App::getLocale() == 'en'){
            $this->message = 'Thanks for your valutation.';
        }elseif(App::getLocale() == 'ro'){
            $this->message = 'Mulțumesc pentru evaluare!';
        }
        $article = Article::find($this->id);
        if(auth()->user()->id != $article->user_id){
            $article->votants += 1;
            $article->stars +=  1;
            $article->save();
        }
        $this->message;
    }
    public function due(){
        if(App::getLocale() == 'it'){
            $this->message = 'Grazie per la tua valutazione.';
        }elseif(App::getLocale() == 'en'){
            $this->message = 'Thanks for your valutation.';
        }elseif(App::getLocale() == 'ro'){
            $this->message = 'Mulțumesc pentru evaluare!';
        }
        $article = Article::find($this->id);
        if(auth()->user()->id != $article->user_id){
            $article->votants += 1;
            $article->stars +=  2;
            $article->save();
        }
        $this->message;
    }
    public function tre(){
        if(App::getLocale() == 'it'){
            $this->message = 'Grazie per la tua valutazione.';
        }elseif(App::getLocale() == 'en'){
            $this->message = 'Thanks for your valutation.';
        }elseif(App::getLocale() == 'ro'){
            $this->message = 'Mulțumesc pentru evaluare!';
        }
        $article = Article::find($this->id);
        if(auth()->user()->id != $article->user_id){
            $article->votants += 1;
            $article->stars +=  3;
            $article->save();
        }
        $this->message;
    }
    public function quattro(){
        if(App::getLocale() == 'it'){
            $this->message = 'Grazie per la tua valutazione.';
        }elseif(App::getLocale() == 'en'){
            $this->message = 'Thanks for your valutation.';
        }elseif(App::getLocale() == 'ro'){
            $this->message = 'Mulțumesc pentru evaluare!';
        }
        $article = Article::find($this->id);
        if(auth()->user()->id != $article->user_id){
            $article->votants += 1;
            $article->stars +=  4;
            $article->save();
        }
        $this->message;
    }
    public function cinque(){
        if(App::getLocale() == 'it'){
            $this->message = 'Grazie per la tua valutazione.';
        }elseif(App::getLocale() == 'en'){
            $this->message = 'Thanks for your valutation.';
        }elseif(App::getLocale() == 'ro'){
            $this->message = 'Mulțumesc pentru evaluare!';
        }
        $article = Article::find($this->id);
        if(auth()->user()->id != $article->user_id){
            $article->votants += 1;
            $article->stars +=  5;
            $article->save();
        }
        $this->message;
    }
}
