<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Filesystem\Media;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class GenerateThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Video $video)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Open the video file and generate a thumbnail
        FFMpeg::fromDisk('public')  // Ensure using the public disk
            ->open($this->video->original_file_path)
            ->getFrameFromSeconds(0)
            ->export()
            ->toDisk('public')  // Ensure saving the file on the public disk
            ->afterSaving(function ($exporter, Media $media) {
                // Save the relative path correctly without the extra 'thumbnails/'
                $thumbnailPath = 'thumbnails/' . basename($media->getPath());  // Just the file name, not the full path

                // Update the video model with the correct relative path
                $this->video->update([
                    'thumbnail_path' => $thumbnailPath,  // Storing relative path
                ]);
            })
            ->save('thumbnails/' . Str::uuid() . '.jpg');  // Save to the public folder's storage path
    }
}
