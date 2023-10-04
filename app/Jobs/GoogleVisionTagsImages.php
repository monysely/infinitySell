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

class GoogleVisionTagsImages implements ShouldQueue
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

        //! avviamo la chiamata alle API
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->labelDetection($file_image);
        $labels = $response->getLabelAnnotations();

        //!controlliamo se ci sono tornate delle labels
        if($labels){
            $result = [];
            foreach($labels as $label) {
                $result[] = $label->getDescription();
            }
            $find_image->labels = $result;
            $find_image->save();
        }
    }
}
