<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialRecord;

class FinancialRecordController extends Controller
{
    /**
     * Display a listing of the records.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $records = FinancialRecord::with('user')->latest()->get();
        } else {
            $records = FinancialRecord::where('user_id', auth()->id())->latest()->get();
        }

        return view('records.index', compact('records'));
    }

    /**
     * Show the form for creating a new record.
     */
    public function create()
    {
        if (auth()->user()->role === 'admin') {
            abort(403, 'Admins cannot modify records.');
        }

        return view('records.create');
    }

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            abort(403, 'Admins cannot modify records.');
        }

        $request->validate([
            'title' => 'required|string|max:255',   
            'amount' => 'required|numeric',
            'type' => 'required|string|in:income,expense', 
            'date' => 'required|date',            
        ]);

        FinancialRecord::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'created_at' => $request->date,        
        ]);

        return redirect()->route('records.index')->with('success', 'Record added successfully.');
    }

    /**
     * Show the form for editing the specified record.
     */
    public function edit(FinancialRecord $record)
    {
        if (auth()->user()->role === 'admin') {
            abort(403, 'Admins cannot modify records.');
        }

        if ($record->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('records.edit', compact('record'));
    }

    /**
     * Update the specified record in storage.
     */
    public function update(Request $request, FinancialRecord $record)
    {
        if (auth()->user()->role === 'admin') {
            abort(403, 'Admins cannot modify records.');
        }

        if ($record->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|string|in:income,expense',
            'date' => 'required|date',             
        ]);

        $record->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'created_at' => $request->date,        
        ]);

        return redirect()->route('records.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified record from storage.
     */
    public function destroy(FinancialRecord $record)
    {
        if (auth()->user()->role === 'admin') {
            abort(403, 'Admins cannot modify records.');
        }

        if ($record->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
