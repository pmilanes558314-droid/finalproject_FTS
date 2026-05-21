<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&display=swap');

        .mn-wrap { display: flex; justify-content: center; margin-top: 40px; padding: 0 16px 48px; }
        .mn-inner { width: 100%; max-width: 1000px; }

        .mn-page-title { font-size: 20px; font-weight: 700; color: #111827; margin: 0 0 24px; letter-spacing: -0.3px; }

        .mn-chart-card { background: #fff; border-radius: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #f0f0f2; overflow: hidden; margin-bottom: 24px; }
        .mn-card-header { display: flex; align-items: center; justify-content: space-between; padding: 20px 28px; border-bottom: 1px solid #f0f0f2; }
        .mn-card-header-left { display: flex; align-items: center; gap: 12px; }
        .mn-card-icon { width: 34px; height: 34px; border-radius: 10px; background: #eff6ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .mn-card-header h3 { font-size: 14px; font-weight: 600; color: #111827; margin: 0; }
        .mn-legend { display: flex; align-items: center; gap: 16px; }
        .mn-legend-item { display: flex; align-items: center; gap: 6px; font-size: 12px; color: #6b7280; font-weight: 500; }
        .mn-legend-dot { width: 10px; height: 10px; border-radius: 2px; }
        .mn-legend-dot.income  { background: #10b981; }
        .mn-legend-dot.expense { background: #ef4444; }
        .mn-chart-body { padding: 24px 28px; }

        .mn-highlight { display: flex; align-items: center; gap: 10px; background: #fff7ed; border: 1px solid #fed7aa; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; font-size: 13px; color: #92400e; font-weight: 500; }

        .mn-table-card { background: #fff; border-radius: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #f0f0f2; overflow: hidden; }
        .mn-table { width: 100%; border-collapse: collapse; }
        .mn-table thead tr { background: #fafafa; }
        .mn-table thead th { padding: 10px 24px; text-align: left; font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #9ca3af; border-bottom: 1px solid #f0f0f2; }
        .mn-table thead th:not(:first-child) { text-align: right; }
        .mn-table tbody td { padding: 13px 24px; font-size: 13.5px; color: #374151; border-bottom: 1px solid #f4f4f6; font-weight: 500; }
        .mn-table tbody td:not(:first-child) { text-align: right; }
        .mn-table tbody tr:last-child td { border-bottom: none; }
        .mn-table tbody tr:hover { background: #f9fafb; }
        .mn-table tbody tr.highlight-row td { background: #fff7ed; }
        .mn-val { font-family: 'DM Mono', monospace; font-size: 13px; font-weight: 600; }
        .mn-val.income  { color: #059669; }
        .mn-val.expense { color: #ef4444; }
        .mn-val.balance { color: #2563eb; }
        .mn-val.zero    { color: #d1d5db; }
    </style>

    <div class="mn-wrap">
        <div class="mn-inner">

            <h1 class="mn-page-title">Monthly Breakdown</h1>

            @php
                $highestExpenseMonth = null;
                $highestExpenseVal   = 0;
                foreach(range(1,12) as $m) {
                    $val = $months[$m]['expense'] ?? 0;
                    if ($val > $highestExpenseVal) {
                        $highestExpenseVal   = $val;
                        $highestExpenseMonth = $m;
                    }
                }
            @endphp

            <div class="mn-chart-card">
                <div class="mn-card-header">
                    <div class="mn-card-header-left">
                        <div class="mn-card-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        </div>
                        <h3>Income vs Expense</h3>
                    </div>
                    <div class="mn-legend">
                        <div class="mn-legend-item"><span class="mn-legend-dot income"></span> Income</div>
                        <div class="mn-legend-item"><span class="mn-legend-dot expense"></span> Expense</div>
                    </div>
                </div>
                <div class="mn-chart-body">
                    <canvas id="monthlyChart" height="100"></canvas>
                </div>
            </div>

            @if($highestExpenseMonth && $highestExpenseVal > 0)
                <div class="mn-highlight">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Highest expense month: <strong>{{ date('F', mktime(0,0,0,$highestExpenseMonth,1)) }}</strong> — ₱{{ number_format($highestExpenseVal, 2) }}
                </div>
            @endif

            <div class="mn-table-card">
                <div class="mn-card-header">
                    <div class="mn-card-header-left">
                        <div class="mn-card-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/></svg>
                        </div>
                        <h3>All Months</h3>
                    </div>
                </div>
                <table class="mn-table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Income</th>
                            <th>Expense</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(range(1,12) as $m)
                            @php
                                $inc = $months[$m]['income']  ?? 0;
                                $exp = $months[$m]['expense'] ?? 0;
                                $bal = $months[$m]['balance'] ?? 0;
                                $isHighest = $m === $highestExpenseMonth && $highestExpenseVal > 0;
                            @endphp
                            <tr class="{{ $isHighest ? 'highlight-row' : '' }}">
                                <td>
                                    {{ date('F', mktime(0,0,0,$m,1)) }}
                                    @if($isHighest)
                                        <span style="margin-left:6px; font-size:11px; font-weight:600; color:#f97316; background:#fed7aa; padding:2px 7px; border-radius:999px;">Peak</span>
                                    @endif
                                </td>
                                <td><span class="mn-val {{ $inc > 0 ? 'income' : 'zero' }}">₱{{ number_format($inc, 2) }}</span></td>
                                <td><span class="mn-val {{ $exp > 0 ? 'expense' : 'zero' }}">₱{{ number_format($exp, 2) }}</span></td>
                                <td><span class="mn-val {{ $bal > 0 ? 'income' : ($bal < 0 ? 'expense' : 'balance') }}">₱{{ number_format($bal, 2) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @php
        $chartIncome  = [];
        $chartExpense = [];
        foreach(range(1,12) as $m) {
            $chartIncome[]  = $months[$m]["income"]  ?? 0;
            $chartExpense[] = $months[$m]["expense"] ?? 0;
        }
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
        const incomeData  = @json($chartIncome);
        const expenseData = @json($chartExpense);

        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Income',
                        data: incomeData,
                        backgroundColor: 'rgba(16,185,129,0.15)',
                        borderColor: '#10b981',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    },
                    {
                        label: 'Expense',
                        data: expenseData,
                        backgroundColor: 'rgba(239,68,68,0.12)',
                        borderColor: '#ef4444',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 12 }, color: '#9ca3af' } },
                    y: {
                        grid: { color: '#f4f4f6' },
                        ticks: {
                            font: { size: 12 }, color: '#9ca3af',
                            callback: v => '₱' + v.toLocaleString()
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>