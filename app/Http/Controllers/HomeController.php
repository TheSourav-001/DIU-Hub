<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Trending: Most downloaded
        $trendingResources = Resource::with(['course.department'])
            ->where('is_approved', true)
            ->orderBy('download_count', 'desc')
            ->take(8)
            ->get();

        // Featured: Highest rated (random selection for variety)
        $featuredResources = Resource::with(['course.department'])
            ->where('is_approved', true)
            ->inRandomOrder()
            ->take(8)
            ->get();

        // Recent: Most recently uploaded
        $recentResources = Resource::with(['course.department'])
            ->where('is_approved', true)
            ->latest()
            ->take(8)
            ->get();

        // Top Contributors: Users with the most uploads
        $topContributors = User::withCount('resources')
            ->having('resources_count', '>', 0)
            ->orderByDesc('resources_count')
            ->take(5)
            ->get();
        // Stats for Counters
        $totalResources = Resource::where('is_approved', true)->count();
        $totalContributors = User::has('resources')->count();
        $totalFaculties = \App\Models\Department::distinct('faculty')->count();

        return view('pages.home', compact(
            'trendingResources', 
            'featuredResources', 
            'recentResources', 
            'topContributors',
            'totalResources',
            'totalContributors',
            'totalFaculties'
        ));
    }
}
