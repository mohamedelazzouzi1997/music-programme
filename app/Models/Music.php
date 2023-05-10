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
        'artist_id'
    ];
        protected $casts = [
        'artist_id' => 'array',
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