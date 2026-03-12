<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() { return $this->belongsTo(User::class); }

    public function scopePending($query) { return $query->where('status', 'pending'); }
}
