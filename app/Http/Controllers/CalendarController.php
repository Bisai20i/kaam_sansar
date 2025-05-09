<?php
namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $calendars = Calendar::all();
        return view('calendars.index', compact('calendars'));
    }

    public function create()
    {
        return view('calendars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'enMonth' => 'required|string',
            'npMonth' => 'required|string',
            'enWeek' => 'required|string',
            'npWeek' => 'required|string',
            'npYear' => 'required|string',
            'enYear' => 'required|string',
            'enDate' => 'required|date',
            'npDate' => 'required|date',
            'dayTitle' => 'required|string',
        ]);

        Calendar::create($request->all());

        return redirect()->route('calendars.index');
    }

    public function show($id)
    {
        $calendar = Calendar::findOrFail($id);
        return view('calendars.show', compact('calendar'));
    }

    public function edit($id)
    {
        $calendar = Calendar::findOrFail($id);
        return view('calendars.edit', compact('calendar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'enMonth' => 'required|string',
            'npMonth' => 'required|string',
            'enWeek' => 'required|string',
            'npWeek' => 'required|string',
            'npYear' => 'required|string',
            'enYear' => 'required|string',
            'enDate' => 'required|date',
            'npDate' => 'required|date',
            'dayTitle' => 'required|string',
        ]);

        $calendar = Calendar::findOrFail($id);
        $calendar->update($request->all());

        return redirect()->route('calendars.index');
    }

    public function destroy($id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();

        return redirect()->route('calendars.index');
    }
}
