<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $user->load('profile.department');

        // Ensure profile exists for the user
        if (!$user->profile) {
            $user->profile()->create();
            $user->load('profile.department');
        }

        $totalUploads = \App\Models\Resource::where('user_id', $user->id)->count();
        $totalDownloads = \App\Models\Download::where('user_id', $user->id)->count();
        $departments = \App\Models\Department::orderBy('faculty')->orderBy('name')->get();

        return view('profile.edit', [
            'user' => $user,
            'profile' => $user->profile,
            'departments' => $departments,
            'totalUploads' => $totalUploads,
            'totalDownloads' => $totalDownloads,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update User Profile fields
        $profile = $user->profile ?: $user->profile()->create();
        
        $profileData = $request->except(['_token', '_method', 'name', 'email', 'avatar']);
        
        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profileData['avatar'] = $path;
        }

        $profile->update($profileData);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
