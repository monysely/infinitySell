<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MakeAnnouncementReadyToReviews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article_id;
    /**
     * Create a new job instance.
     */
    public function __construct($article_id)
    {
        $this->article_id = $article_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $article = Article::find($this->article_id);

        if(!$article->is_accepted){
            return;
        }

        $article->is_accepted = null;
        $article->save();
    }
}
