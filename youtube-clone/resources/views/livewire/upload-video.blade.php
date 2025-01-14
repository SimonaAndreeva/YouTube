<x-modal wire:model="modal" title="Upload Video">
    <form x-data="{
        uploader: null,
        progress: 0,
        submit() {
            const file = $refs.file.files[0]

            if (!file) {
                return
            }

            this.uploader = createUpload({
                file: file,
                endpoint: '{{ route('video.upload') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'post',
                chunkSize: 50 * 1024, // 10mb
            })

            this.uploader.on('chunkSuccess', (response) => {
                if (!response.detail.response.body) {
                    return
                }

                $wire.call('handleSuccess', file.name, JSON.parse(response.detail.response.body).file)
            })

            this.uploader.on('progress', (progress) => {
                this.progress = progress.detail
            })

            this.uploader.on('success', () => {
                this.uploader = null
                this.progress = 100
            })
        }
    }">
        <div>
            <label x-show="progress === 0"
                class="flex w-full h-40 border-2 border-gray-400 border-dashed justify-center items-center"
                for="video">
                <span class="flex items-center space-x-2">
                    <i class="fas fa-upload text-gray-500"></i>
                    <span class="text-lg font-semibold text-gray-700">Upload Video</span>
                </span>
                <input type="file" x-on:change.prevent="submit" x-ref="file" class="hidden" id="video">
            </label>
        </div>

        <template x-if="uploader">
            <div class="space-y-1">
                <x-progress x-bind:value="progress" max="100" />
            </div>
        </template>
    </form>

    @if ($uploaded)
    <x-form wire:submit.prevent="updateVideo">
        <div wire:poll>
            @if (!$video->thumbnail_path)
            <div class="skeleton w-full h-52"></div>
            @endif

            @if ($video->thumbnail_path)
            <div class="w-full">
                <img src="{{ asset('storage/' . $video->thumbnail_path) }}" class="w-full rounded-lg" />
            </div>
            @endif
        </div>

        <div class="space-y-2">
            <x-input label="Title" wire:model="form.title" />
            <x-textarea hint="Max 1000 characters" label="Description" wire:model="form.description" />
            <x-tags id="tags" label="Tags" wire:model="form.tags" />
        </div>

        @if ($video->thumbnail_path)
        <button wire:click="updateVideo" class="btn btn-primary" type="button">Publish</button>
        @endif

    </x-form>
    @endif
</x-modal>