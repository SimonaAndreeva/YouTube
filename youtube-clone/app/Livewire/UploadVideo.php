<?php

namespace App\Livewire;

use App\Jobs\EncodeVideo;
use Illuminate\Support\Facades\Log;
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

    // Update video details, including the thumbnail path if a new one was uploaded
    public function updateVideo()
    {
        // Validate the form data
        $this->form->validate();

        // Prepare the data to update
        $updateData = [
            'title' => $this->form->title,
            'description' => $this->form->description,
            'tags' => $this->form->tags,
        ];

        // Retain the current thumbnail_path (don't update it from form)
        $updateData['thumbnail_path'] = $this->video->thumbnail_path;

        // Set live_at to tomorrow's date (hardcoded)
        $updateData['live_at'] = now()->addDay()->toDateTimeString(); // Tomorrow's date

        try {
            // Perform the update on the video
            $this->video->update($updateData);

            // Close the modal after the update
            $this->modal = false;

            // Show a success toast
            $this->toast(
                title: 'Video Updated',
                description: 'Your video has been successfully updated!',
                type: 'success'
            );

            // Redirect to the home route after success
            $this->redirect(route('home'));
        } catch (\Exception $e) {
            Log::error('Error updating video', ['error' => $e->getMessage()]);
            $this->toast(
                title: 'Update Failed',
                description: 'There was an issue updating your video. Please try again.',
                type: 'error'
            );
        }
    }





    public function render()
    {
        return view('livewire.upload-video');
    }
}
