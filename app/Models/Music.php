<?php

namespace App\Models;

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
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}