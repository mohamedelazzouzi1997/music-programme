<?php

namespace App\Models;

use App\Models\Music;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_available',
        'music_id',
        'fixed_music_id'
    ];
        protected $casts = [
        'music_id' => 'array',
        'fixed_music_id' => 'array'
    ];

    public function musics()

    {
        return $this->belongsToMany(Music::class, 'music_artists','artist_id','music_id');
    }
}