<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Install extends Model
{
    protected $casts = [
        "date" => "datetime:Y-m-d h:i"
    ];
    protected $guarded = [];
    use HasFactory;
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'code', 'serial');
    }
}
