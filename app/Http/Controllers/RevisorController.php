<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Article;
use App\Mail\BecomeRevisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LavoraConNoi;
use App\Mail\AnnouncementPublished;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class RevisorController extends Controller
{
    //! home page revisore, passo tutti gli annunci ancora da approvare
    public function index(){
        //!
        $actual_user = auth()->user()->id;
        $date = Carbon::now();;
        $article_to_check = Article::where('is_accepted', null)->where('user_id', '!=', $actual_user)->first();
        $prev_article = DB::table('articles')->where('is_accepted', '!=', null)->latest('updated_at')->get()->first();
        return view('revisore.index', ['article'=>$article_to_check, 'prevArticle'=>$prev_article, 'date'=>$date]);
    }

    public function acceptArticle(Article $id){
        Mail::to($id->user->email)->send(new AnnouncementPublished($id));
        $id->setAccepted(true);
        return redirect()->route('revisor.index')->with('success', 'Annuncio approvato.');
    }

    public function rejectArticle(Article $id){
        $id->setAccepted(false);
        return redirect()->route('revisor.index')->with('fail', 'Annuncio rifiutato.');
    }

    public function undo(Article $id){
        $id->setAccepted(null);
        return redirect()->route('revisor.index')->with('info', 'Ultima operazione annullata con successo, l\'annuncio potrà essere di nuovo valutato.');
    }

    public function becomeRevisor(LavoraConNoi $request){
        try {
            $file_id = uniqid();
            $file_name = 'CV-' . auth()->user()->name . '-' . $file_id . '.' . $request->file('file')->extension();
            if(!File::isDirectory('cv')){
                Storage::makeDirectory('public/cv');
            }
            $save_my_cv = $request->file('file')->storeAs('public/cv/', $file_name);
            $user = auth()->user();
            Mail::to('admin@infinitysell.it')->send(new BecomeRevisor($user, '/cv/' . $file_name));
            return redirect()->back()->with('success', 'La tua candidatura è stata inviata correttamente, ti risponderemo nel più breve tempo possibile.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Ops, qualcosa è andato storto, riprova più tardi...');
        }
    }

    public function makeRevisor(User $user){
        Artisan::call('app:make-user-revisor', ["email"=>$user->email]);
        return redirect()->route('home')->with('success', 'Approvazione ruolo di revisore avvenuta con successo');
    }

    public function history(){
        if(auth()->user()->is_revisor){
            $users = User::all();
            // $articles = Article::orderBy('created_at', 'desc')->get();
            $articles = DB::table('articles')->where('is_accepted', '!=', null)->orderByDesc('created_at')->paginate(15);
            return view('revisore.history', compact('articles', 'users'));
        }else {
            return redirect()->route('home')->with('access.denied', 'Non hai i permessi necessari per accedere alla sezione del sito!');
        }
    }
}
