<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;

class AdminController extends Controller
{
    public function dashboard()
    {
        $resources = Resource::with(['user', 'course'])->latest()->paginate(20);
        return view('admin.dashboard', compact('resources'));
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->back()->with('success', 'Resource deleted successfully');
    }
}
