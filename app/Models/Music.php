<?php

namespace App\Models;

use App\Models\Artist;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'time',
        'category_id',
        'type',
        'coeurs',
        'artist_id',
        'comment',
    ];
        protected $casts = [
        'artist_id' => 'array',
        'coeurs' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function artists()

    {
        return $this->belongsToMany(Artist::class, 'music_artists','music_id','artist_id');
    }
}