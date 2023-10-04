<?php

namespace App\Jobs;

use Spatie\Image\Image;
use App\Models\ArticleImage;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ApplyWatermark implements ShouldQueue
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

        
        $path = storage_path() . '/app/public/'. $this->article_id . '/' . "crop_1000x1000" . $img_file_name;

        $image = Image::load($path);

        $image->watermark(storage_path() . '/app/public/site/watermark.png')
            ->watermarkPosition(Manipulations::POSITION_TOP_RIGHT)
            ->watermarkPadding(3, 3, Manipulations::UNIT_PERCENT)
            ->watermarkOpacity(75);

        $image->save($path);
    }
}
