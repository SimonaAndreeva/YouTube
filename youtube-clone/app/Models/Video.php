<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail_path',
        'original_file_path',
        'live_at',
        'tags'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function formats() : HasMany {
        return $this->hasMany(VideoFormat::class);
    }

    

}
