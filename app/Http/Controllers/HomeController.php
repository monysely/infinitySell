<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueGenerator;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //! rotta per home page
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->limit(8)->get();
        return view('home.index', ['articles'=>$articles]);
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
    public function show($id)
    {
        
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

    public function category($category){
        $articles = Article::where('is_accepted', true)->where('category_id', $category)->get();
        $category = Category::find($category);
        return view('home.category', ['articles'=>$articles, 'category'=>$category]);
    }

    public function candidatura(){
        if(!auth()->user()->is_revisor){
            return view('revisore.candidatura');
        }else {
            return redirect()->route('home')->with('fail', 'Ci risulta che sei già un nostro revisore!');
        }
    }

    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
    }
}


