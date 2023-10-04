<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\ourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\Console\Descriptor\ReStructuredTextDescriptor;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $word = '';
        if(App::getLocale() == 'it'){
            $word = 'Tutti gli annunci';
        }elseif(App::getLocale() == 'en'){
            $word = 'All announcements';
        }else{
            $word = 'Toate anunțurile';
        }
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'DESC')->paginate(8);
        return view('article.index', ['articles'=> $articles,'word'=>$word]);
    }

    //!ricerca per categoria TNT
    public function searchArticles(Request $request){
        if($request->cerca == null || $request->cerca == ' '){
            return redirect()->route('home')->with('empty', 'Scrivi nel campo di ricerca cosa dovremmo cercare per te...');
        }else{
            $word = '';
            if(App::getLocale() == 'it'){
                $word = 'Risultati per: ';
            }elseif(App::getLocale() == 'en'){
                $word = 'Results for: ';
            }else{
                $word = 'Rezultate pentru: ';
            }
            // dd(GoogleTranslate::trans($request->cerca, app()->getLocale()));
            $articles = Article::search($request->cerca)->where('is_accepted', true)->paginate(8);
            return view('article.index', ['articles'=>$articles, 'word'=>$word . '"'.$request->cerca.'"']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->check()){
            $our_categories = Category::all();
            return view('article.create', ['ourCategories'=>$our_categories]);
        }else {
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
    public function show($title, $id)
    {   
        $article = Article::find($id);
        $category = Category::find($article->category_id);
        $reviews = User::find($article->user_id)->reviews;

        if (isset($_COOKIE[$article->id])) {
            //! se il cookie esiste
            
        }else{
        //!se il cookie NON esiste.
        $arr_cookie_options = array (
            'expires' => time() + 900,
            'path' => '/', 
            'domain' => '', // leading dot for compatibility or use subdomain
            'secure' => true,     // or false
            'httponly' => true,    // or false
            'samesite' => 'Lax' // None || Lax  || Strict
            );
            setcookie($article->id, $article->id, $arr_cookie_options);
            if(auth()->check()){
                if(auth()->user()->id != $article->user_id){
                    $article->clicks += 1;
                    $article->save();
                }
            }else{
                $article->clicks += 1;
                $article->save();
            }
        };
        return view('article.show', ['article'=>$article, 'category'=>$category, 'reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if($article->user_id == auth()->user()->id){
            $article->delete();
        }
        return redirect()->route('user.articles')->with('success', 'Annuncio eliminato con successo!');
    }

    public function searchCategory(Request $request){
        $articles = Article::where('category_id', $request->category)->get();
        $category = Category::find($request->category);
        return view('home.category', ['articles'=>$articles, 'category'=>$category]);
    }
}
