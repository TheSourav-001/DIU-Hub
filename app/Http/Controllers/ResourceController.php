<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Course;
use App\Models\Department;
use App\Models\ResourceRequest;
use App\Models\Notification;
use App\Services\FileScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::with(['user', 'course.department'])->where('is_approved', true);
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        if ($request->has('course_name') && $request->course_name) {
            $query->whereHas('course', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->course_name}%");
            });
        }
        if ($request->has('course_code') && $request->course_code) {
            $query->whereHas('course', function($q) use ($request) {
                $q->where('code', 'like', "%{$request->course_code}%");
            });
        }
        
        if ($request->has('department_id') && $request->department_id) {
            $query->whereHas('course', function($q) use ($request) {
                $q->where('department_id', $request->department_id);
            });
        }

        if ($request->has('semester') && $request->semester) {
            $query->where('semester', $request->semester);
        }

        if ($request->has('exam_type') && $request->exam_type) {
            $query->where('exam_type', $request->exam_type);
        }

        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('name', strtolower($request->tag));
            });
        }
        
        $resources = $query->latest()->paginate(12)->withQueryString();
        $departments = Department::orderBy('faculty')->orderBy('name')->get();
        
        return view('pages.explore', compact('resources', 'departments'));
    }

    public function show(Resource $resource)
    {
        if (!$resource->is_approved && Auth::id() !== $resource->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $resource->load(['user', 'course.department', 'ratings', 'tags']);
        
        // Recommendation System (Related Materials from the same course)
        $relatedResources = Resource::with(['course'])
            ->where('course_id', $resource->course_id)
            ->where('id', '!=', $resource->id)
            ->where('is_approved', true)
            ->latest()
            ->take(3)
            ->get();
        $isBookmarked = false;
        if (Auth::check()) {
            $isBookmarked = \App\Models\Bookmark::where('user_id', Auth::id())
                ->where('resource_id', $resource->id)
                ->exists();
        }
        
        return view('pages.resource-details', compact('resource', 'relatedResources', 'isBookmarked'));
    }

    public function create()
    {
        $departments = Department::with('courses')->orderBy('faculty')->orderBy('name')->get();
        return view('pages.upload', compact('departments'));
    }

    public function store(Request $request)
    {
        // 1. Strict Validation (OWASP)
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'course_code'   => 'required|string|max:20',
            'semester'      => 'required|string|max:50',
            'exam_type'     => 'required|string|max:50',
            'description'   => 'nullable|string|max:1000',
            'tags'          => 'nullable|string|max:255',
            // Allow all file types up to 20MB
            'file'          => 'required|file|max:20480', 
        ]);

        // Find or Create Course
        $courseCode = strtoupper(trim($validated['course_code']));
        $course = Course::firstOrCreate(
            ['code' => $courseCode, 'department_id' => $validated['department_id']],
            ['name' => $courseCode] // Default name to code if new
        );

        // 2. Malware Scan — block dangerous files before storing
        $scanResult = FileScanner::scan($request->file('file'));
        if (!$scanResult['safe']) {
            return back()->withErrors(['file' => $scanResult['reason']])->withInput();
        }

        // 3. Secure Storage (Stored hashed in storage/app/study_materials)
        $path = $request->file('file')->store('study_materials');

        // 3. Database Entry (HTML outputs will be escaped using Blade {{ }})
        $resource = Resource::create([
            'user_id'     => Auth::id(),
            'course_id'   => $course->id,
            'title'       => htmlspecialchars($validated['title'], ENT_QUOTES, 'UTF-8'), // XSS protection
            'description' => htmlspecialchars($validated['description'] ?? '', ENT_QUOTES, 'UTF-8'),
            'semester'    => $validated['semester'],
            'exam_type'   => $validated['exam_type'],
            'file_path'   => $path,
            'file_type'   => $request->file('file')->getClientOriginalExtension() ?: 'unknown',
            'file_size'   => $request->file('file')->getSize(),
            'is_approved' => true, // Auto approve for students
        ]);
        
        // Tags Logic
        if (!empty($validated['tags'])) {
            $tagNames = array_map('trim', explode(',', $validated['tags']));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = \App\Models\Tag::firstOrCreate(['name' => strtolower($tagName)]);
                    $tagIds[] = $tag->id;
                }
            }
            $resource->tags()->sync($tagIds);
        }

        // --- Smart Matching: Notify users whose requests match this upload ---
        $departmentName = $course->department->name ?? '';
        $matchingRequests = ResourceRequest::pending()
            ->where(function ($q) use ($courseCode, $departmentName, $validated) {
                $q->where('course_code', $courseCode);
                // Also match by similar title
                $titleWords = array_filter(explode(' ', $validated['title']), fn($w) => strlen($w) > 3);
                foreach ($titleWords as $word) {
                    $q->orWhere('title', 'like', '%' . $word . '%');
                }
            })
            ->where('user_id', '!=', Auth::id()) // Don't notify the uploader themselves
            ->get();

        foreach ($matchingRequests as $req) {
            Notification::create([
                'user_id'     => $req->user_id,
                'title'       => 'Resource Match Found!',
                'message'     => 'A resource matching your request "' . $req->title . '" has been uploaded: ' . $validated['title'],
                'resource_id' => $resource->id,
            ]);
            $req->update(['status' => 'fulfilled']);
        }

        return redirect()->route('dashboard')->with('success', 'Study resource uploaded successfully!');
    }

    public function download(Resource $resource)
    {
        if (!$resource->is_approved && Auth::id() !== $resource->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Increment download count securely
        $resource->increment('download_count');
        
        // Log the download history if it's not the owner
        if (Auth::id() !== $resource->user_id) {
            \App\Models\Download::firstOrCreate([
                'user_id' => Auth::id(),
                'resource_id' => $resource->id
            ]);
        }

        return Storage::download($resource->file_path, $resource->title . '.' . $resource->file_type);
    }

    public function preview(Resource $resource)
    {
        // Only approved resources can be previewed publicly
        if (!$resource->is_approved) {
            if (!Auth::check() || (Auth::id() !== $resource->user_id && Auth::user()->role !== 'admin')) {
                abort(403);
            }
        }

        // Verify file exists before attempting to serve
        if (!Storage::exists($resource->file_path)) {
            abort(404, 'File not found.');
        }

        $headers = [
            'Content-Type' => Storage::mimeType($resource->file_path),
            'Content-Disposition' => 'inline; filename="' . $resource->title . '.' . $resource->file_type . '"',
            'Cache-Control' => 'public, max-age=86400', // Cache for 24h for performance
        ];

        return response()->file(storage_path('app/private/' . $resource->file_path), $headers);
    }
}
