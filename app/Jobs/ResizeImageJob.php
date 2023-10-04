<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ResizeImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $w;
    private $h;
    private $fileName;
    private $articleID;

    /**
     * Create a new job instance.
     */
    public function __construct($fileName, $w, $h, $articleID)
    {
        $this->fileName = $fileName;
        $this->w = $w;
        $this->h = $h;
        $this->articleID = $articleID;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = storage_path() . '/app/public/' . $this->articleID . '/' . $this->fileName;
        $destPath = storage_path() . '/app/public/'. $this->articleID . '/' . "crop_{$this->w}x{$this->h}" . $this->fileName;
        Image::load($path)
                    ->crop(Manipulations::CROP_CENTER, $this->w, $this->h)
                    ->save($destPath);

        Storage::delete('public/' . $this->articleID . '/' . $this->fileName);
    }
}
