<?php

namespace App\Jobs;

use App\Models\ArticleImage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class GoogleRemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $image_id;
    private $article_id;
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
        //! troviamo l'img nel database cercando con l'ID
        $find_photo = ArticleImage::find($this->image_id);
        //! troviamo il nome del file immagine
        $img_file_name = $find_photo->file_name;
        
        //! troviamo il FILE immagine
        $file_image = file_get_contents(storage_path() . '/app/public/'. $this->article_id . '/' . $img_file_name);
        //! percorso del file immagine
        $file_image_path = storage_path() . '/app/public/'. $this->article_id . '/' . $img_file_name;

        //! permettiamo la lettura del file con le credenziali
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.base_path('google_credential.json'));

        //! avviamo l'istanza di google vision passando l'immagine come parametro in ingresso per l'analisi
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->faceDetection($file_image);
        $faces = $response->getFaceAnnotations();

        //! controlliamo se ci sono volti
        if($faces){
            //! cicliamo l'array di volti e per ogni volto salviamo le coordinate di quel volto.
            foreach($faces as $face){
                $vertices = $face->getBoundingPoly()->getVertices();
                $bounds = [];

                foreach($vertices as $vertex){
                    $bounds[] = [$vertex->getX(), $vertex->getY()];
                }
            $w = $bounds[2][0] - $bounds[0][0];
            $h = $bounds[2][1] - $bounds[0][1];

            $image = Image::load($file_image_path);

            $image->watermark(storage_path() . '/app/public/site/sticker.png')
                ->watermarkPosition('top-left')
                ->watermarkPadding($bounds[0][0], $bounds[0][1])
                ->watermarkWidth($w, Manipulations::UNIT_PIXELS)
                ->watermarkHeight($h, Manipulations::UNIT_PIXELS)
                ->watermarkFit(Manipulations::FIT_STRETCH);

            $image->save($file_image_path);
            }
        }
    }
}
