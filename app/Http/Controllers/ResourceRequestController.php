<?php

namespace App\Http\Controllers;

use App\Models\ResourceRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceRequestController extends Controller
{
    public function index()
    {
        $requests = ResourceRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.requests', compact('requests'));
    }

    public function create()
    {
        $departments = Department::orderBy('faculty')->orderBy('name')->get();
        return view('pages.request-create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'course_code'   => 'required|string|max:20',
            'department'    => 'required|string|max:255',
            'semester'      => 'required|string|max:50',
            'resource_type' => 'required|string|max:50',
            'description'   => 'nullable|string|max:1000',
        ]);

        ResourceRequest::create([
            'user_id'       => Auth::id(),
            'title'         => htmlspecialchars($validated['title'], ENT_QUOTES, 'UTF-8'),
            'course_code'   => strtoupper(trim($validated['course_code'])),
            'department'    => htmlspecialchars($validated['department'], ENT_QUOTES, 'UTF-8'),
            'semester'      => $validated['semester'],
            'resource_type' => $validated['resource_type'],
            'description'   => htmlspecialchars($validated['description'] ?? '', ENT_QUOTES, 'UTF-8'),
            'status'        => 'pending',
        ]);

        return redirect()->route('resource-requests.index')
            ->with('success', 'Your resource request has been submitted! You will be notified when a matching resource is uploaded.');
    }
}
