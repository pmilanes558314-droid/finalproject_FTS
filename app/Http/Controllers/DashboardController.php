<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FinancialRecord;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the main dashboard page with selected month totals.
     */
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month') ?? Carbon::now()->month;
        $selectedYear = Carbon::now()->year;

        $income = FinancialRecord::where('user_id', auth()->id())
            ->where('type', 'income')
            ->whereMonth('record_date', $selectedMonth)
            ->whereYear('record_date', $selectedYear)
            ->sum('amount');

        $expense = FinancialRecord::where('user_id', auth()->id())
            ->where('type', 'expense')
            ->whereMonth('record_date', $selectedMonth)
            ->whereYear('record_date', $selectedYear)
            ->sum('amount');

        $balance = $income - $expense;

        // Total remaining balance across ALL months
        $totalBalance = FinancialRecord::where('user_id', auth()->id())
            ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE -amount END) as total")
            ->value('total') ?? 0;

        return view('dashboard', [
            'income'        => $income,
            'expense'       => $expense,
            'balance'       => $balance,
            'selectedMonth' => $selectedMonth,
            'totalBalance'  => $totalBalance,
        ]);
    }

    /**
     * Show monthly breakdown of income, expense, and balance.
     */
    public function monthlyReport()
    {
        $userId = auth()->id();

        $records = DB::table('financial_records')
            ->selectRaw('MONTH(record_date) as month,
                         SUM(CASE WHEN type="income" THEN amount ELSE 0 END) as total_income,
                         SUM(CASE WHEN type="expense" THEN amount ELSE 0 END) as total_expense')
            ->where('user_id', $userId)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        foreach ($records as $record) {
            $months[$record->month] = [
                'income'  => $record->total_income,
                'expense' => $record->total_expense,
                'balance' => $record->total_income - $record->total_expense,
            ];
        }

        return view('reports.monthly', compact('months'));
    }
}