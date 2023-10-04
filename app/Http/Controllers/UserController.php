<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Review;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserToSellerMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\MailToSellerRequest;
use PhpParser\Lexer\TokenEmulator\ReverseEmulator;

class UserController extends Controller
{
    //! rotta profilo utente
    public function profile(){
        $user = auth()->user();
        $articles_counter = User::find($user->id)->articles->count();
        $reviews = Review::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $utenti = User::all();
        return view('user.profile', ['user'=>$user, 'articles_counter'=>$articles_counter, 'reviews'=>$reviews, 'utenti'=>$utenti]);
    }

    public function profilePeoples($id){
        $user = User::find($id);
        $articles_counter = User::find($user->id)->articles->count();
        $reviews = Review::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $utenti = User::all();
        return view('user.public-profile', ['user'=>$user, 'articles_counter'=>$articles_counter, 'reviews'=>$reviews, 'utenti'=>$utenti]);
    }

    //! rotta annunci pubblicati dall'utente
    public function articles(){
        $articles = User::find(auth()->user()->id)->articles()->get();
        return view('user.articles', ['articles'=>$articles]);
    }

    public function userArticles($name, $id){
        $articles = User::find($id)->articles()->get();
        return view('user.user-articles', ['articles'=>$articles, 'name'=>$name]);
    }

    public function addFavourite(Request $request, $myArticle, $user){
        // dd($myArticle);
        $myArticle = intval($myArticle);
        //! tutti i like che l'utente ha messo
        $find_likes = Like::where('user_id', auth()->user()->id)->get();

        //! controlliamo se ha messo già like a questo annuncio
        $already = [];

        if(!empty($find_likes)){
            foreach($find_likes as $annuncio){
                foreach($annuncio->articles as $article){
                    if($article->id == $myArticle){
                        array_push($already, $article->id);
                    }
                }
            }
        }

        //! se non c'è aggiungiamo ai preferiti altrimenti NO
        if(!empty($already)){
            return redirect()->back()->with('fail', 'Hai già aggiunto questo annuncio nei preferiti!');
        }else{
            $like = new Like();
            $like->user_id = $user;
            $like->save();

            $article = Article::find($myArticle);
            $article->likes()->attach($like->id);
            return redirect()->back()->with('success', 'Annuncio aggiunto ai preferiti!');
        }
    }

    public function removeFavourite(Request $request, $myArticle, $user){
        $myArticle = Article::find($myArticle);
        
        foreach($myArticle->likes as $like){
            if($like->user_id == auth()->user()->id){
                $like->delete();
            }
        }
        return redirect()->back()->with('fail', 'Annuncio rimosso dai preferiti!');
    }

    //! eliminazione account utente
    public function deleteAccount(){
        $actual_user = auth()->user()->id;
        $user_to_delete = User::find($actual_user);
        $user_to_delete->delete();
        return redirect()->route('home')->with('success', 'Account eliminato, speriamo di riaverti presto con noi!');
    }


    public function preferiti(){
        $favorites = Like::where('user_id', auth()->user()->id)->get();
        return view('user.favourites', ['favorites'=>$favorites]);
    }

    //! mail to seller from user
    public function mailToSeller(Request $request){
        $seller_name = $request->seller_name;
        $seller_email = $request->seller_email;
        $article_title = $request->article_title;
        $user_email = $request->user_mail;
        $user_message = $request->user_message;
        $article_id = $request->article_id;
        
        if(!$user_email || !$user_message) {
            return redirect()->route('article.detail', ['title'=> Str::slug($article_title), 'id'=>$article_id])->with('fail', 'Errore invio mail, compila correttamente tutti i campi del form.');
        }elseif($user_email && $user_message) {
            try {
                Mail::to($seller_email)->send(new UserToSellerMail($seller_name, $user_email, $user_message, $article_title));
                return redirect()->route('article.detail', ['title'=> Str::slug($article_title), 'id'=>$article_id])->with('success', 'Mail inviata, il venditore ti risponderà prima possibile.');
            } catch (\Throwable $th) {
                return redirect()->route('article.detail', ['title'=> Str::slug($article_title), 'id'=>$article_id])->with('fail', 'Ops...qualcosa è andato storto...errore interno del server.');
            }
        }
    }

    //! lascia una revisione
    public function leaveReview(Request $request, $user_id){
        if(!$request->review_message){
            return redirect()->back()->with('fail', 'La recensione non verrà pubblicata in quanto non hai compilato correttamente tutti i campi del form.');
        }else{
            $review = new Review();
            $review->content = $request->review_message;
            $review->user_id = $user_id;
            $review->writer_id = auth()->user()->id;
            $review->save();
    
            return redirect()->back()->with('success', 'Recensione pubblicata con successo!');
        }

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
