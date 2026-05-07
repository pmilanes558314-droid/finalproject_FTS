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
        $records = FinancialRecord::where('user_id', auth()->id())
            ->orderBy('record_date', 'asc')
            ->get();

        return view('records.index', compact('records'));
    }

    /**
     * Show the form for creating a new record.
     */
    public function create()
    {
        return view('records.create');
    }

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'record_date' => 'required|date',
        ]);

        FinancialRecord::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'title' => $request->title,
            'amount' => $request->amount,
            'record_date' => $request->record_date,
        ]);

        // ✅ Redirect after saving
        return redirect()->route('records.index')->with('success', 'Transaction added successfully.');
    }

    /**
     * Show the form for editing the specified record.
     */
    public function edit(FinancialRecord $record)
    {
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
        $request->validate([
            'type' => 'required|in:income,expense',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'record_date' => 'required|date',
        ]);

        $record->update([
            'type' => $request->type,
            'title' => $request->title,
            'amount' => $request->amount,
            'record_date' => $request->record_date,
        ]);

        return redirect()->route('records.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified record from storage.
     */
    public function destroy(FinancialRecord $record)
    {
        if ($record->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
