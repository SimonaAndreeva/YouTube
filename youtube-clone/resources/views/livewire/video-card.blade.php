<div x-data="{ playing: false }">
    <div class="col-span-4">
        <x-card class="shadow-lg">
            <!-- Video Section -->
            <x-slot:figure>
                <video
                    x-ref="player"
                    @mouseenter="playing = true; $refs.player.play()"
                    @mouseleave="playing = false; $refs.player.pause(); $refs.player.currentTime = 0"
                    id="player"
                    muted
                    loop
                    preload="metadata"
                    class="rounded-lg w-full"
                    poster="{{ asset('storage/' . $video->thumbnail_path) }}"
                    data-poster="{{ asset('storage/' . $video->thumbnail_path) }}">
                    @foreach($video->formats as $format)
                    <source src="{{ asset('storage/' . $format->file_path) }}" type="video/mp4" size="{{ $format->quality }}" />
                    @endforeach
                </video>
            </x-slot:figure>

            <!-- Content Section -->
            <div class="space-y-2 p-4">
                <!-- Profile Picture and Metadata -->
                <div class="flex items-center justify-between">
                    <!-- Profile -->
                    <div class="flex items-center space-x-3">
                        <a href="#" wire:navigate>
                            <img
                                src="{{ $video->user->profile_photo_url }}"
                                alt="User Profile"
                                class="rounded-full w-10 h-10" />
                        </a>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $video->user->name }}</p>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="flex items-center space-x-3 text-gray-500 text-sm">
                        <span>12k</span>
                        <span class="border-l h-4 border-gray-300"></span>
                        <time datetime="{{ $video->created_at }}" title="{{ $video->created_at }}">
                            {{ $video->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>

                <!-- Video Title -->
                <h2 class="text-lg font-semibold text-gray-900 truncate">{{ $video->title }}</h2>
            </div>
        </x-card>
    </div>
</div>