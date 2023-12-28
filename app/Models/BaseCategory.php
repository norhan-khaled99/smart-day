<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseCategory extends Model
{
    protected $guarded = [];
    public function mediaManager()
    {
        return $this->belongsTo(MediaManager::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    use HasFactory;
}
