<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'point1',
        'point2',
        'point3',
        'point4',
        'comments',
        'serial'
    ];

    public function install()
    {
        // return $this->belongsTo(Install::class,'serial');
        return $this->belongsTo(Install::class, 'serial', 'serial');

    }
}
