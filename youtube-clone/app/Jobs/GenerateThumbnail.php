<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
        // Use Laravel FFMpeg to extract the thumbnail
        $thumbnailLocalPath = storage_path('app/temp_thumbnails/' . Str::uuid() . '.jpg');

        FFMpeg::fromDisk('public') // Ensure it's using the 'public' disk
            ->open($this->video->original_file_path) // Open the original video file
            ->getFrameFromSeconds(1) // Get the frame at the first second (change this if needed)
            ->export() // Export the frame
            ->save($thumbnailLocalPath); // Save it temporarily

        // Upload the thumbnail to Cloudinary
        $cloudinaryUpload = Cloudinary::upload($thumbnailLocalPath, [
            'folder' => 'thumbnails',
        ]);

        // Get the secure URL from Cloudinary
        $thumbnailUrl = $cloudinaryUpload->getSecurePath();

        // Update the thumbnail_path in the database with the Cloudinary URL
        $this->video->update([
            'thumbnail_path' => $thumbnailUrl,
        ]);

        // Delete the local temporary file
        unlink($thumbnailLocalPath);
    }
}
