<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DailyActivity;
use App\Models\User;

class DailyActivityController
{

    public function index()
    {
        $events = DailyActivity::all();
        return view('staff.activity.index', compact('events'));
    }

    public function create()
    {
        return view('staff.activity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|in:on_going,completed,cancelled',
        ]);

        $activity = new DailyActivity();
        $activity->user_id = auth()->user()->id;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->date = $request->date;
        $activity->start_time = $request->start_time;
        $activity->end_time = $request->end_time;
        $activity->status = $request->status;
        
        // Ambil organization_id dari user yang sedang login
        $user = \App\Models\User::find(auth()->user()->id);
        if (!$user->organization_id) {
            // Jika user belum memiliki organization_id, set default ke 1
            $user->organization_id = 1;
            $user->save();
        }
        $activity->organization_id = $user->organization_id;
        
        $activity->save();

        return redirect()->route('staff.activity.index')->with('success', 'Activity created successfully!');
    }

    public function edit($id)
    {
        $event = DailyActivity::findOrFail($id);
        return view('staff.activity.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|in:on_going,completed,cancelled',
        ]);

        $activity = DailyActivity::findOrFail($id);
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->date = $request->date;
        $activity->start_time = $request->start_time;
        $activity->end_time = $request->end_time;
        $activity->status = $request->status;
        $activity->save();

        return redirect()->route('staff.activity.index')->with('success', 'Activity updated successfully!');
    }

    public function destroy($id)
    {
        $activity = DailyActivity::findOrFail($id);
        $activity->delete();
        
        return redirect()->route('staff.activity.index')->with('success', 'Activity deleted successfully!');
    }
}
