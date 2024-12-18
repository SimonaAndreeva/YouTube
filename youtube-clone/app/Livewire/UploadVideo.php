<?php

namespace App\Livewire;

use Livewire\Attribute\On;
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

    public function toggleModal()
    {
        $this->modal = !$this->modal;
    }

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

        $save->handler();
    }
    

    public function handleSuccess($name, $path)
    {
        $file = new UploadedFile(storage_path('app/chunks/' . $path), $name);

        $this->video = auth()->user()->videos()->create([
            'title' => $file->getClientOriginalName(),
            'original_file_path' => $file->storeAs('videos', Str::uuid() . '.mp4')
        ]);

    }

    public function render()
    {
        return view('livewire.upload-video');
    }
}

