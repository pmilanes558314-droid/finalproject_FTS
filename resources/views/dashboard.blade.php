<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&display=swap');

        .db-wrap { display: flex; justify-content: center; margin-top: 40px; padding: 0 16px 48px; }
        .db-inner { width: 100%; max-width: 860px; }

        .db-greeting { font-size: 13px; color: #9ca3af; margin-bottom: 4px; }
        .db-name { font-size: 22px; font-weight: 700; color: #111827; margin: 0 0 28px; letter-spacing: -0.4px; }

        /* Month Selector */
        .db-month-bar { display: flex; align-items: center; gap: 12px; margin-bottom: 28px; }
        .db-month-bar label { font-size: 13px; font-weight: 600; color: #374151; }

        .db-month-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 7px 14px; border-radius: 9px;
            border: 1px solid #e5e7eb; background: #fff;
            font-size: 13px; font-weight: 600; color: #111827;
            cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: border-color 0.15s, box-shadow 0.15s;
            position: relative;
        }
        .db-month-btn:hover { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
        .db-month-btn svg { color: #9ca3af; }

        /* Picker Popup */
        .db-picker-popup {
            position: fixed;
            width: 270px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.13);
            z-index: 9999;
            display: none;
            overflow: hidden;
        }
        .db-picker-popup.open { display: block; animation: dbPickerIn 0.18s ease; }

        @keyframes dbPickerIn {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .db-picker-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 16px; border-bottom: 1px solid #f0f0f2;
        }
        .db-picker-year-nav { display: flex; align-items: center; gap: 10px; }
        .db-picker-year-btn {
            width: 26px; height: 26px; border-radius: 6px;
            border: 1px solid #e5e7eb; background: #fff;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            color: #6b7280; transition: background 0.12s;
        }
        .db-picker-year-btn:hover { background: #f5f5f7; }
        .db-picker-year-btn:disabled { opacity: 0.3; cursor: default; }
        .db-picker-year-label { font-size: 14px; font-weight: 700; color: #111827; min-width: 44px; text-align: center; }

        .db-picker-months {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 6px; padding: 12px;
        }
        .db-picker-month-btn {
            padding: 8px 4px; border-radius: 8px;
            border: 1px solid transparent; background: none;
            font-size: 12.5px; font-weight: 500; color: #374151;
            cursor: pointer; text-align: center;
            transition: background 0.12s, color 0.12s;
        }
        .db-picker-month-btn:hover:not(:disabled) { background: #f5f5f7; }
        .db-picker-month-btn.selected { background: #3b82f6; color: #fff; border-color: #3b82f6; font-weight: 600; }
        .db-picker-month-btn:disabled { color: #d1d5db; cursor: default; }

        /* Summary Cards */
        .db-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px; }
        .db-card { border-radius: 14px; padding: 20px 22px; border: 1px solid #f0f0f2; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.05); }
        .db-card-label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #9ca3af; margin-bottom: 8px; display: flex; align-items: center; gap: 7px; }
        .db-card-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
        .db-card-dot.income  { background: #10b981; }
        .db-card-dot.expense { background: #ef4444; }
        .db-card-dot.balance { background: #3b82f6; }
        .db-card-amount { font-family: 'DM Mono', monospace; font-size: 22px; font-weight: 600; }
        .db-card-amount.income  { color: #059669; }
        .db-card-amount.expense { color: #ef4444; }
        .db-card-amount.balance { color: #2563eb; }

        /* Total Balance Banner */
        .db-total-banner { border-radius: 14px; padding: 20px 24px; margin-bottom: 28px; background: linear-gradient(135deg, #9f75e9 0%, #8044e0 100%); box-shadow: 0 4px 16px rgba(124,58,237,0.25); display: flex; align-items: center; justify-content: space-between; }
        .db-total-banner-left { display: flex; align-items: center; gap: 14px; }
        .db-total-icon { width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .db-total-label { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(255,255,255,0.7); margin-bottom: 4px; }
        .db-total-sub { font-size: 11.5px; color: rgba(255,255,255,0.55); }
        .db-total-amount { font-family: 'DM Mono', monospace; font-size: 26px; font-weight: 700; color: #fff; letter-spacing: -0.5px; }

        /* Table */
        .db-card-wrap { background: #fff; border-radius: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #f0f0f2; }
        .db-table-header { display: flex; align-items: center; gap: 12px; padding: 20px 28px; border-bottom: 1px solid #f0f0f2; }
        .db-table-header-icon { width: 34px; height: 34px; border-radius: 10px; background: #eff6ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .db-table-header h3 { font-size: 14px; font-weight: 600; color: #111827; margin: 0; }
        .db-table { width: 100%; border-collapse: collapse; }
        .db-table thead tr { background: #fafafa; }
        .db-table thead th { padding: 10px 28px; text-align: left; font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #9ca3af; border-bottom: 1px solid #f0f0f2; }
        .db-table tbody td { padding: 15px 28px; font-size: 13.5px; color: #374151; border-bottom: 1px solid #f4f4f6; font-weight: 500; }
        .db-table tbody tr:last-child td { border-bottom: none; }
        .db-table tbody tr:hover { background: #f9fafb; }
        .db-table .val { font-family: 'DM Mono', monospace; font-size: 13px; font-weight: 600; }
        .db-table .val.income  { color: #059669; }
        .db-table .val.expense { color: #ef4444; }
        .db-table .val.balance { color: #2563eb; }
    </style>

    <div class="db-wrap">
        <div class="db-inner">

            <p class="db-greeting">Good day,</p>
            <h1 class="db-name">{{ Auth::user()->name }} 👋</h1>

            {{-- Hidden form submitted by JS --}}
            <form method="GET" action="{{ route('dashboard') }}" id="monthForm">
                <input type="hidden" name="month" id="monthInput" value="{{ $selectedMonth }}">
            </form>

            <!-- Month Selector -->
            <div class="db-month-bar">
                <label>Showing data for</label>
                <button type="button" class="db-month-btn" id="dbMonthBtn" onclick="toggleDbPicker()">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span id="dbMonthLabel">{{ \Carbon\Carbon::parse(now()->year . '-' . $selectedMonth . '-01')->format('F Y') }}</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
            </div>

            <!-- Picker Popup -->
            <div class="db-picker-popup" id="dbPickerPopup">
                <div class="db-picker-header">
                    <div class="db-picker-year-nav">
                        <button class="db-picker-year-btn" id="dbPrevYear" onclick="dbChangeYear(-1)">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <span class="db-picker-year-label" id="dbPickerYearLabel"></span>
                        <button class="db-picker-year-btn" id="dbNextYear" onclick="dbChangeYear(1)">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
                    </div>
                </div>
                <div class="db-picker-months" id="dbPickerMonths"></div>
            </div>

            <!-- Summary Cards -->
            <div class="db-cards">
                <div class="db-card">
                    <div class="db-card-label"><span class="db-card-dot income"></span> Income</div>
                    <div class="db-card-amount income">₱{{ number_format($income, 2) }}</div>
                </div>
                <div class="db-card">
                    <div class="db-card-label"><span class="db-card-dot expense"></span> Expense</div>
                    <div class="db-card-amount expense">₱{{ number_format($expense, 2) }}</div>
                </div>
                <div class="db-card">
                    <div class="db-card-label"><span class="db-card-dot balance"></span> Balance</div>
                    <div class="db-card-amount balance">₱{{ number_format($balance, 2) }}</div>
                </div>
            </div>

            <!-- All-Time Total Balance Banner -->
            <div class="db-total-banner">
                <div class="db-total-banner-left">
                    <div class="db-total-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    </div>
                    <div>
                        <div class="db-total-label">Total Remaining Balance</div>
                        <div class="db-total-sub">Sum of all monthly balances across the year</div>
                    </div>
                </div>
                <div class="db-total-amount">₱{{ number_format($totalBalance, 2) }}</div>
            </div>

            <!-- Breakdown Table -->
            <div class="db-card-wrap">
                <div class="db-table-header">
                    <div class="db-table-header-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/></svg>
                    </div>
                    <h3>{{ \Carbon\Carbon::parse(now()->year . '-' . $selectedMonth . '-01')->format('F') }} Breakdown</h3>
                </div>
                <table class="db-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Income</td>
                            <td><span class="val income">₱{{ number_format($income, 2) }}</span></td>
                        </tr>
                        <tr>
                            <td>Expense</td>
                            <td><span class="val expense">₱{{ number_format($expense, 2) }}</span></td>
                        </tr>
                        <tr>
                            <td>Balance</td>
                            <td><span class="val balance">₱{{ number_format($balance, 2) }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        const MONTHS_SHORT = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const MONTHS_FULL  = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        const TODAY_YEAR  = {{ now()->year }};
        const TODAY_MONTH = {{ now()->month - 1 }}; // 0-indexed

        // Selected = what the controller returned (1-indexed from PHP → convert to 0-indexed)
        let dbPickerYear     = TODAY_YEAR;
        let dbSelectedMonth  = {{ $selectedMonth }} - 1; // 0-indexed
        let dbSelectedYear   = TODAY_YEAR;

        function renderDbMonths() {
            const container = document.getElementById('dbPickerMonths');
            container.innerHTML = '';

            MONTHS_SHORT.forEach((m, i) => {
                const btn = document.createElement('button');
                btn.className = 'db-picker-month-btn';
                btn.textContent = m;

                // Disable future months in the current year
                const isFuture = dbPickerYear === TODAY_YEAR && i > TODAY_MONTH;
                // Disable any month in a future year
                const isFutureYear = dbPickerYear > TODAY_YEAR;

                if (isFuture || isFutureYear) {
                    btn.disabled = true;
                } else {
                    btn.onclick = () => dbSelectMonth(dbPickerYear, i);
                }

                if (dbSelectedYear === dbPickerYear && dbSelectedMonth === i) {
                    btn.classList.add('selected');
                }

                container.appendChild(btn);
            });

            document.getElementById('dbPickerYearLabel').textContent = dbPickerYear;

            // Disable next year btn if already at current year
            document.getElementById('dbNextYear').disabled = dbPickerYear >= TODAY_YEAR;
        }

        function toggleDbPicker() {
            const popup = document.getElementById('dbPickerPopup');
            const btn   = document.getElementById('dbMonthBtn');
            const isOpen = popup.classList.contains('open');

            if (!isOpen) {
                const rect = btn.getBoundingClientRect();
                popup.style.top  = (rect.bottom + 8) + 'px';
                popup.style.left = rect.left + 'px';
                dbPickerYear = dbSelectedYear;
                renderDbMonths();
            }

            popup.classList.toggle('open', !isOpen);
        }

        function dbChangeYear(delta) {
            const newYear = dbPickerYear + delta;
            if (newYear > TODAY_YEAR) return; // never go beyond current year
            dbPickerYear = newYear;
            renderDbMonths();
        }

        function dbSelectMonth(year, monthIndex) {
            dbSelectedYear  = year;
            dbSelectedMonth = monthIndex;

            // Update button label
            document.getElementById('dbMonthLabel').textContent =
                MONTHS_FULL[monthIndex] + ' ' + year;

            // Submit form
            document.getElementById('monthInput').value = monthIndex + 1; // back to 1-indexed
            document.getElementById('dbPickerPopup').classList.remove('open');
            document.getElementById('monthForm').submit();
        }

        // Close on outside click
        document.addEventListener('click', function(e) {
            const popup = document.getElementById('dbPickerPopup');
            const btn   = document.getElementById('dbMonthBtn');
            if (!popup.contains(e.target) && !btn.contains(e.target)) {
                popup.classList.remove('open');
            }
        });
    </script>
</x-app-layout>