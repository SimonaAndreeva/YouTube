<?php

namespace App\Livewire;

use Livewire\Attribute\On;
use App\Jobs\EncodeVideo;
use App\Livewire\Forms\UploadVideoForm;
use Livewire\Component;
use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Handler\ContentRangeUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadVideo extends Component
{
    public bool $modal = false;

    protected $listeners = ['toggleModal'];
    public UploadVideoForm $form;
    public bool $uploaded = false;


    // Toggle the modal visibility
    public function toggleModal()
    {
        $this->modal = !$this->modal;
    }

    // Handle chunked file uploads
    public function handleChunk(Request $request)
    {
        $receiver = new FileReceiver(
            UploadedFile::fake()->createWithContent('file', $request->getContent()),
            $request,
            ContentRangeUploadHandler::class
        );

        $save = $receiver->receive();

        if ($save->isFinished()) {
            return response()->json([
                'file' => $save->getFile()->getFilename()
            ]);
        }

        // Handle chunk processing
        $save->handler();
    }

    // Handle the file upload completion and save the video record
    public function handleSuccess($name, $path)
    {
        // Ensure the file is stored in the 'videos' folder inside 'app/videos' directory
        $file = new UploadedFile(storage_path('app/chunks/' . $path), $name);

        // Store the file using the 'videos' disk
        $filePath = $file->storeAs('videos', Str::uuid() . '.mp4', 'videos'); // or 'videos' if you created a custom disk for videos

        // Assign the created video model to a local variable $video
        $video = auth()->user()->videos()->create([
            'title' => $file->getClientOriginalName(),
            'original_file_path' => $filePath, // Store the file path
        ]);

        $this->uploaded = true;
        // Dispatch the EncodeVideo job with the $video instance
        EncodeVideo::dispatch($video);
    }


    public function render()
    {
        return view('livewire.upload-video');
    }
}
