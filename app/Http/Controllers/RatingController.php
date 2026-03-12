<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Resource $resource)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000'
        ]);

        Rating::updateOrCreate(
            ['user_id' => Auth::id(), 'resource_id' => $resource->id],
            ['rating' => $request->rating, 'review' => htmlspecialchars($request->review ?? '', ENT_QUOTES, 'UTF-8')]
        );

        return back()->with('success', 'Your rating has been saved.');
    }
}
