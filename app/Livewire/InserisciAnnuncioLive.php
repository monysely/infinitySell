<?php

namespace App\Livewire;

use App\Jobs\ApplyWatermark;
use App\Jobs\GoogleRemoveFaces;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\GoogleVisionTagsImages;
use App\Jobs\MakeAnnouncementReadyToReviews;
use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\File;
use App\Models\ourCategory;
use App\Jobs\ResizeImageJob;
use App\Models\ArticleImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class InserisciAnnuncioLive extends Component
{
    use WithFileUploads;
    public $title;
    public $content;
    public $category;
    public $price;
    public $success;
    public $fail;
    public $temporary_images;
    public $images = [];
    public $iteration = 0;

    public $imagesToDelete = [];


    public function updated($name)
    {
        $this->validateOnly($name, [
            'title' => 'required|min:3|not_regex:/^.*https:.*$/i',
            'content' => 'required|min:10|not_regex:/^.*https:.*$/i',
            'price' => 'required|max:6',
            'category' => 'required',
            'images' => 'required',
        ]);
    }

    public function render()
    {
        $ourCategories = Category::orderBy('ita', 'asc')->get();
        return view('livewire.inserisci-annuncio-live', ['ourCategories'=>$ourCategories]);
    }


    public function updatedTemporaryImages(){
        $validated = $this->validate([ 
            'temporary_images.*' => 'mimes:jpg,jpeg,png|max:2048|required',
        ]);

        if($validated){
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }

        
    }

    public function removeImage($key){
        if(in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    

    public function store()
    {
        if(auth()->check()){

            $validated = $this->validate([
                'title' => 'required|min:3|not_regex:/^.*https:.*$/i',
                'content' => 'required|min:10|not_regex:/^.*https:.*$/i',
                'price' => 'required|max:6',
                'category' => 'required',
                'images' => 'required',
            ]);

            if($validated){
                // try {
                    $article = new Article();
                    $article->title =   $this->title;
                    $article->content = $this->content;
                    $article->user_id = auth()->user()->id;
                    $article->category_id = $this->category;
                    $article->price = $this->price;
                    $article->is_accepted = 5;
                    $article->save();

                    //! creiamo la cartella per le foto che ha per nome l'ID dell'articolo appena creato.
                    Storage::makeDirectory('public/' . $article->id);


                    foreach($this->images as $image){
                        $file_id = uniqid();
                        $file_name = 'article-image-' . $file_id . '.' . $image->extension();
                        $articleImage = new ArticleImage();
                        $articleImage->file_name = $file_name;
                        $articleImage->fileId = $file_id;
                        $articleImage->article_id = $article->id;
                        $articleImage->save();
                        $save_my_image = $image->storeAs('public/' . $article->id, $file_name);

                        GoogleRemoveFaces::withChain([
                            new ResizeImageJob($articleImage->file_name, 1000, 1000, $article->id),
                            new GoogleVisionSafeSearch($articleImage->id, $article->id),
                            new GoogleVisionTagsImages($articleImage->id, $article->id),   
                            new ApplyWatermark($articleImage->id, $article->id),   
                            new MakeAnnouncementReadyToReviews($article->id),
                        ])->dispatch($articleImage->id, $article->id);

                    }

                    
                    $this->success = 'Annuncio inserito, verrà pubblicato in home page dopo nostra revisione!';
                    $this->reset(['title', 'content', 'category', 'price', 'images']);
                    $this->iteration++;

            Storage::deleteDirectory('livewire-tmp');
                // } catch (\Throwable $th) {
                //     $this->fail = 'Ops, qualcosa è andato storto, inserisci nuovamente l\'annuncio!';
                // }
            }
        }
    }

    public function messages(){
        return [
            'title' => [
                'required' => 'Titolo obbligatorio',
                'min' => 'Devi inserire almeno 3 caratteri',
                'not_regex' => 'Il titolo non può contenere un link',
            ],
            'content' => [
                'required'=> 'Descrivi il tuo Articolo nel miglior modo possibile.',
                'min' => 'Devi inserire almeno 10 caratteri',
                'not_regex' => 'Il testo dell\'articolo non può contenere un link',
            ],
            'price' => [
                'required' => 'Prezzo obbligatorio.',
                'max' => 'Il prezzo non deve avere più di 6 cifre',

            ],
            'category' => 'Devi selezionare una Categoria.',

            
            'images.required' => 'Un annuncio con delle Foto ha più probabilità di vendita, ti consigliamo di aggiungerne almeno una.',
            'images.max' => 'Massima dimensione per file 2Mb',
            'images.mimes' => 'Estensioni ammesse: .jpg, .jpeg, .png',

            'temporary_images.*.required' => 'Un annuncio con delle Foto ha più probabilità di vendita, ti consigliamo di aggiungerne almeno una.',
            'temporary_images.*.max' => 'Massima dimensione per file 2Mb',
            'temporary_images.*.mimes' => 'Estensioni ammesse: .jpg, .jpeg, .png',
                
        ];
    }
}
