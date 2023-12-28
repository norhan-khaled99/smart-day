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
        // Add other fields here as needed
    ];
    public function install()
    {
        return $this->hasOne(Install::class, 'serial', 'code');
    }

}
