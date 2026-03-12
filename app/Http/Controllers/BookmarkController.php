<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::with(['resource.course', 'resource.course.department'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('pages.bookmarks', compact('bookmarks'));
    }

    public function toggle(Resource $resource)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
                            ->where('resource_id', $resource->id)
                            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $status = 'removed';
            $message = 'Bookmark removed.';
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'resource_id' => $resource->id
            ]);
            $status = 'added';
            $message = 'Resource bookmarked successfully.';
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'bookmarked' => ($status === 'added')
            ]);
        }

        return back()->with('success', $message);
    }
}
