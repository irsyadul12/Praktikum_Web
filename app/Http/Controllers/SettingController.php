<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all settings from the database
        $settings = Setting::all()->keyBy('key');
        return view('settings.index', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'app_name' => 'required|string|max:255',
            'pagination_limit' => 'required|integer|min:1',
            // Add other setting validations here
        ]);

        // Update or create settings
        Setting::updateOrCreate(['key' => 'app_name'], ['value' => $request->input('app_name')]);
        Setting::updateOrCreate(['key' => 'pagination_limit'], ['value' => $request->input('pagination_limit')]);
        // Update or create other settings here

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }

    // You might want to add other methods like edit, update, destroy if settings are managed individually
}
