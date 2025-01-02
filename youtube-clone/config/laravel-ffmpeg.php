<?php

return [
    'ffmpeg' => [
        'binaries' => env('FFMPEG_BINARIES', 'ffmpeg'), // Path to FFmpeg binary
        'threads' => 12, // Number of threads to use
    ],

    'ffprobe' => [
        'binaries' => env('FFPROBE_BINARIES', 'ffprobe'), // Path to FFprobe binary
    ],

    'timeout' => 3600, // Timeout for FFmpeg operations

    'log_channel' => env('LOG_CHANNEL', 'stack'), // Logging channel, set to false to disable logging

    'temporary_files_root' => env('FFMPEG_TEMPORARY_FILES_ROOT', sys_get_temp_dir()), // Root directory for temporary files

    'temporary_files_encrypted_hls' => env('FFMPEG_TEMPORARY_ENCRYPTED_HLS', env('FFMPEG_TEMPORARY_FILES_ROOT', sys_get_temp_dir())), // Temp dir for encrypted HLS files
];
