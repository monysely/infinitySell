<?php

namespace App\Jobs;

use App\Models\ArticleImage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image_id;
    protected $article_id;
    /**
     * Create a new job instance.
     */
    public function __construct($image_id, $article_id)
    {
        $this->image_id = $image_id;
        $this->article_id = $article_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //! eseguiamo il find dell'immagine nel db
        $find_image = ArticleImage::find($this->image_id);
        $file_name = $find_image->file_name;

        //! otteniamo il FILE immagine e lo salviamo nella variabile
        $file_image = file_get_contents(storage_path() . '/app/public/'. $this->article_id . '/' . "crop_1000x1000" . $file_name);


        //! permettiamo la lettura del file con le credenziali
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.base_path('google_credential.json'));

        //! instanziamo la classe delle API
        $imageAnnotator = new ImageAnnotatorClient();
        //! chiamiamo il metodo per l'analisi e gli diamo in pasto il file image
        $response = $imageAnnotator->safeSearchDetection($file_image);
        //! chiudiamo la connessione con le API di google vision

        //! salviamo le annotazioni della responde
        $annotations = $response->getSafeSearchAnnotation();

        //! saliviamo in delle variabili separate tutti i valori delle notations
        $adult = $annotations->getAdult();
        $medical = $annotations->getMedical();
        $spoof = $annotations->getSpoof();
        $violence = $annotations->getViolence();
        $racy = $annotations->getRacy();

        $class_for_votes = [
            'fa-face-meh text-secondary',
            'fa-face-laugh-beam text-success',
            'fa-face-grin-wide text-success',
            'fa-face-grimace text-warning',
            'fa-face-flushed text-warning',
            'fa-face-dizzy text-danger',
        ];

        $find_image->adult = $class_for_votes[$adult];
        $find_image->medical = $class_for_votes[$medical];
        $find_image->spoof = $class_for_votes[$spoof];
        $find_image->violence = $class_for_votes[$violence];
        $find_image->racy = $class_for_votes[$racy];

        $find_image->save();

    }
}
