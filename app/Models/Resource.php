<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user() { return $this->belongsTo(User::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function ratings() { return $this->hasMany(Rating::class); }
    public function bookmarks() { return $this->hasMany(Bookmark::class); }
    public function downloads() { return $this->hasMany(Download::class); }
    public function tags() { return $this->belongsToMany(Tag::class, 'resource_tags'); }
}
