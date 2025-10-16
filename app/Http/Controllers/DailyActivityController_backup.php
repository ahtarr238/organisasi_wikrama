<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DailyActivity;

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
        
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
    
    }

    public function destroy($id)
    {

    }
}
