<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function musics()
    {
        return $this->hasMany(Music::class);
    }

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
    ];
}