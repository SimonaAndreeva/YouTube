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
                chunkSize: 10 * 1024, // 10mb
            })

            this.uploader.on('chunkSuccess', (response) => {
                if (!response.detail.response.body) {
                    return
                }

                $wire.call('handleSuccess', file.name, JSON.parse(response.detail.response.body).file)
            })

           
        }
    }">
        <div>
            <label class="flex w-full h-40 border-2 border-gray-400 border-dashed justify-center items-center cursor-pointer" for="video">
                <input type="file" x-on:change.prevent="submit" x-ref="file" class="hidden" id="video">

                <!-- Icon and label for "Upload Video" -->
                <span class="flex items-center space-x-2">
                    <!-- Font Awesome Upload Icon -->
                    <i class="fas fa-upload text-gray-500"></i>

                    <!-- Label Text -->
                    <span class="text-lg font-semibold text-gray-700">Upload Video</span>
                </span>
            </label>
        </div>
    </form>
</x-modal>
