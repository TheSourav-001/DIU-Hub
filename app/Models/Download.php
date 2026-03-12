<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user() { return $this->belongsTo(User::class); }
    public function resource() { return $this->belongsTo(Resource::class); }
}
