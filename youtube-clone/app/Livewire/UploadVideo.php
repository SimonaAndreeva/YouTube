<?php

namespace App\Livewire;

use App\Jobs\EncodeVideo;
use App\Jobs\GenerateThumbnail;
use App\Livewire\Forms\UploadVideoForm;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use Pion\Laravel\ChunkUpload\Handler\ContentRangeUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadVideo extends Component
{
    use WithFileUploads;
    use Toast;
    public bool $modal = false;
    public UploadVideoForm $form;
    public bool $uploaded = false;
    public Video $video;

    protected $listeners = ['toggleModal'];
    


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
        $file = new UploadedFile(storage_path('app/chunks/' . $path), $name);

        $filePath = $file->storeAs('videos', Str::uuid() . '.mp4', 'videos');

        $video = auth()->user()->videos()->create([
            'title' => $file->getClientOriginalName(),
            'original_file_path' => $filePath,
        ]);

        $this->video = $video;

        $this->uploaded = true;

        // Dispatch encoding and thumbnail generation jobs
        EncodeVideo::dispatch($video);
        GenerateThumbnail::dispatch($this->video);

       
    }



    public function render()
    {
        return view('livewire.upload-video');
    }
}
