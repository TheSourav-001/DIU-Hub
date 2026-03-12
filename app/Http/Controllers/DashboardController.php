<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\Download;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function student()
    {
        $user = Auth::user();
        
        $myResources = Resource::where('user_id', $user->id)->latest()->take(5)->get();
        
        $recentDownloads = Download::where('user_id', $user->id)
            ->with('resource')
            ->latest()
            ->take(5)
            ->get();
            
        $totalUploads = Resource::where('user_id', $user->id)->count();
        $totalDownloads = Download::where('user_id', $user->id)->count();
        
        return view('pages.dashboard', compact('user', 'myResources', 'recentDownloads', 'totalUploads', 'totalDownloads'));
    }

    public function bookmarks()
    {
        $bookmarks = \App\Models\Bookmark::with(['resource.course'])->where('user_id', Auth::id())->latest()->paginate(12);
        return view('pages.bookmarks', compact('bookmarks'));
    }
}
