<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeConrtoller;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//! ROTTE HOME CONTROLLER
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/annunci/categoria/{category}', [HomeController::class, 'category'])->name('article.category');
Route::get('/lavora-con-noi/candidatura', [HomeController::class, 'candidatura'])->name('candidatura')->middleware(['auth', 'verified']);


//!ROTTE PER ARTICLES CONTROLLER
Route::get('/annunci/inserisci', [ArticleController::class, 'create'])->name('article.create')->middleware(['auth', 'verified']);
Route::get('/annuncio/{title}/{id}', [ArticleController::class, 'show'])->name('article.detail');
Route::get('/annunci', [ArticleController::class, 'index'])->name('article.index');
Route::post('/annunci/cerca/categoria', [ArticleController::class, 'searchCategory'])->name('article.search');
Route::post('/annunci/elimina/{id}', [ArticleController::class, 'destroy'])->name('article.destroy')->middleware('auth', 'verified');


//!rotta per ricerca TNT
Route::get('/annunci/tnt/search', [ArticleController::class, 'searchArticles'])->name('article.ricerca');


//! login con github
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    
    try {
        $githubUser = Socialite::driver('github')->user();
    
        $finduser = User::where('email', $githubUser->email)->first();
        
        if($finduser){
            //if the user exists, login and show dashboard
            $user = DB::table('users')->where('email', $githubUser->email)->update(['github_id'=>$githubUser->id]);
    
            Auth::login($finduser);
            return redirect()->route('article.create');
        }else{
            //! se mi arriva da git il nome utente vuoto
            if(!$githubUser->name){
                $githubUser->name = ' ';
            };
            $user = User::create([
                'github_id' => $githubUser->id,
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
                'password' => encrypt($githubUser->token),
                'role' => 'user',
            ]);
        }
     
        Auth::login($user);
    
        return redirect('/annunci/inserisci');
    } catch (Exception) {
        return redirect()->route('login')->with('fail', 'Qualcosa è andato storto...effetua di nuovo il login per continuare!');
    }

    
});

//! rotte per login con google
Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);


//! ROTTE REVISORE CONTROLLER
Route::get('/revisore', [RevisorController::class, 'index'])->name('revisor.index')->middleware('isRevisor');
//todo bottoni accetta e rifiuta
Route::patch('/accetta/annuncio/{id}', [RevisorController::class, 'acceptArticle'])->name('revisor.accept-article')->middleware('isRevisor');
Route::patch('/rifiuta/annuncio/{id}', [RevisorController::class, 'rejectArticle'])->name('revisor.reject-article')->middleware('isRevisor');
Route::patch('/annulla/annuncio/{id}', [RevisorController::class, 'undo'])->name('revisor.undo-article')->middleware('isRevisor');
//todo rotta per richiesta ruolo
Route::post('/revisore/richiesta', [RevisorController::class, 'becomeRevisor'])->name('become.revisor')->middleware(['auth', 'verified']);
//todo rotta per approvazione ruolo
Route::get('/revisore/approva/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');
//! rotta per cronologia approvazioni
Route::get('/revisore/cronologia', [RevisorController::class, 'history'])->name('revisor.history')->middleware('isRevisor');

//!google translate routes
// Route::get('lang/home', [LangController::class, 'index']);
// Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

//!traduttore Aulab rotte
Route::post('/lingua/{lang}', [HomeController::class, 'setLanguage'])->name('set_language_locale');

//! rotte UTENTE
Route::get('/profilo/{name}', [UserController::class, 'profile'])->name('user.profile')->middleware(['auth']);

Route::get('/profilo-pubblico/{id}', [UserController::class, 'profilePeoples'])->name('user.profilePeoples')->middleware(['auth']);

Route::get('/utente/i-miei-annunci', [UserController::class, 'articles'])->name('user.articles')->middleware(['auth', 'verified']);

Route::get('/utente/gli-annunci-di/{name}/{id}', [UserController::class, 'userArticles'])->name('user.user-articles')->middleware(['auth', 'verified']);

Route::post('/utente/aggiungi/preferito/{myArticle}/{user}', [UserController::class, 'addFavourite'])->name('user.add-favourite')->middleware(['auth', 'verified']);
Route::post('/utente/rimuovi/preferito/{myArticle}/{user}', [UserController::class, 'removeFavourite'])->name('user.remove-favourite')->middleware(['auth', 'verified']);
Route::post('/utente/profilo/elimina', [UserController::class, 'deleteAccount'])->name('user.delete')->middleware(['auth', 'verified']);
Route::get('/utente/preferiti', [UserController::class, 'preferiti'])->name('user.preferiti')->middleware(['auth', 'verified']);
//* mail to seller route
Route::post('/utente/contatta/venditore', [UserController::class, 'mailToSeller'])->name('user.contact.seller')->middleware(['auth', 'verified']);
Route::post('/scrivi-recensione/{user_id}', [UserController::class, 'leaveReview'])->name('user.leaveReview')->middleware(['auth', 'verified']);




