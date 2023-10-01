<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Record;

class RecordController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        // Validation
        $request->validate([
            'line_user_id' => 'required|string', // Add validation rule for line_user_id
            'record_date' => 'required|date', // Add validation rule for record_date
            'time_of_day' => 'required|string|in:morning,afternoon,evening', // Add validation rule for time_of_day
            'content' => 'nullable|string', // Add validation rule for content
            'protein' => 'nullable|numeric', // Allow null
            'lipid' => 'nullable|numeric',   // Allow null, also make sure this should be 'lipid' or 'fat' based on your DB
            'vitamin' => 'nullable|numeric', // Allow null
            'carbohydrate' => 'nullable|numeric', // Allow null
            'mineral' => 'nullable|numeric', // Allow null
        ]);

       // Data insertion
        $result = Record::create($request->all());

        // Redirection with Success Message
        // return redirect()->route('record.show', ['id' => $result->id]);
      return redirect()->route('message.show', ['request' => $result->id])->with('success', 'Record successfully created');
    }
    
    public function show($id)
{
    $record = Record::find($id);
    return view('records.recordshow', ['record' => $record]);
}
}