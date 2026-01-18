<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Notifications\ProfileUpdated;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $user->notify(new ProfileUpdated($user->name)); // Dispatch notification

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $user->notify(new ProfileUpdated($user->name)); // Dispatch notification

        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }

    public function settings()
    {
        return view('settings.index');
    }

    public function activityLog()
    {
        // For a full activity log, you would query a dedicated logging system or database table.
        // For now, this is a placeholder.
        $activities = []; // Example: retrieve some recent activities
        return view('activity_log.index', compact('activities'));
    }
}
