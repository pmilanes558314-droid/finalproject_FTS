<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&display=swap');

        .tx-wrap { display: flex; justify-content: center; margin-top: 40px; padding: 0 16px 48px; }
        .tx-inner { width: 100%; max-width: 1024px; }
        .tx-card { background: #fff; border-radius: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #f0f0f2; }

        .tx-header { display: flex; align-items: center; gap: 12px; padding: 22px 32px; border-bottom: 1px solid #f0f0f2; }
        .tx-header h2 { font-size: 15px; font-weight: 600; color: #111827; margin: 0; letter-spacing: -0.2px; flex: 1; }

        .tx-header-icon-btn {
            width: 36px; height: 36px; border-radius: 10px; background: #eff6ff;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            border: none; cursor: pointer; position: relative;
            transition: background 0.15s, box-shadow 0.15s;
        }
        .tx-header-icon-btn:hover { background: #dbeafe; box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }
        .tx-header-icon-btn.active { background: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.2); }
        .tx-header-icon-btn.active svg { stroke: #fff; }

        .tx-filter-badge {
            display: none;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #2563eb;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 999px;
            padding: 3px 10px;
        }
        .tx-filter-badge.visible { display: inline-flex; }
        .tx-filter-badge-close {
            cursor: pointer;
            color: #93c5fd;
            font-size: 14px;
            line-height: 1;
            margin-left: 2px;
        }
        .tx-filter-badge-close:hover { color: #2563eb; }

        .picker-popup {
            position: fixed;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            width: 260px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            z-index: 9999;
            display: none;
            overflow: hidden;
        }
        .picker-popup.open { display: block; animation: pickerIn 0.18s ease; }

        @keyframes pickerIn {
            from { opacity: 0; transform: translateX(-50%) translateY(-6px); }
            to   { opacity: 1; transform: translateX(-50%) translateY(0); }
        }

        .picker-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-bottom: 1px solid #f0f0f2;
        }

        .picker-year-nav {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .picker-year-btn {
            width: 26px; height: 26px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: #fff;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #6b7280;
            transition: background 0.12s;
        }
        .picker-year-btn:hover { background: #f5f5f7; }

        .picker-year-label {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            min-width: 48px;
            text-align: center;
        }

        .picker-clear {
            font-size: 11.5px;
            font-weight: 600;
            color: #9ca3af;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            transition: background 0.12s, color 0.12s;
        }
        .picker-clear:hover { background: #f5f5f7; color: #374151; }

        .picker-months {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
            padding: 12px;
        }

        .picker-month-btn {
            padding: 8px 4px;
            border-radius: 8px;
            border: 1px solid transparent;
            background: none;
            font-size: 12.5px;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            text-align: center;
            transition: background 0.12s, color 0.12s, border-color 0.12s;
        }
        .picker-month-btn:hover { background: #f5f5f7; }
        .picker-month-btn.selected { background: #3b82f6; color: #fff; border-color: #3b82f6; font-weight: 600; }

        .tx-alert { margin: 16px 24px 0; display: flex; align-items: center; gap: 8px; padding: 11px 16px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; font-size: 13px; font-weight: 500; color: #065f46; }

        .tx-table { width: 100%; border-collapse: collapse; }
        .tx-table thead tr { background: #fafafa; }
        .tx-table thead th { padding: 10px 24px; text-align: left; font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #9ca3af; border-bottom: 1px solid #f0f0f2; }
        .tx-table tbody tr { transition: background 0.12s; }
        .tx-table tbody tr:hover { background: #f9fafb; }
        .tx-table tbody td { padding: 14px 24px; font-size: 13.5px; color: #374151; border-bottom: 1px solid #f4f4f6; }
        .tx-table tbody tr:last-child td { border-bottom: none; }
        .tx-table tbody tr.hidden-row { display: none; }

        .td-title { font-weight: 500; color: #111827; }
        .td-amount { font-family: 'DM Mono', monospace; font-size: 13px; font-weight: 500; }
        .td-amount.income { color: #059669; }
        .td-amount.expense { color: #ef4444; }

        .tx-badge { display: inline-flex; align-items: center; gap: 6px; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
        .tx-badge .dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
        .tx-badge.income { background: #ecfdf5; color: #065f46; }
        .tx-badge.income .dot { background: #10b981; }
        .tx-badge.expense { background: #fff1f2; color: #be123c; }
        .tx-badge.expense .dot { background: #ef4444; }

        .td-date { font-family: 'DM Mono', monospace; font-size: 12px; color: #9ca3af; }
        .tx-actions { display: flex; align-items: center; gap: 8px; }

        .btn-edit { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #fff; background: #3b82f6; border: none; text-decoration: none; cursor: pointer; transition: background 0.15s; box-shadow: 0 1px 3px rgba(59,130,246,0.3); }
        .btn-edit:hover { background: #2563eb; }
        .btn-delete { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #fff; background: #ef4444; border: none; cursor: pointer; transition: background 0.15s; box-shadow: 0 1px 3px rgba(239,68,68,0.3); }
        .btn-delete:hover { background: #dc2626; }

        .tx-empty { padding: 60px 20px; text-align: center; color: #9ca3af; font-size: 13.5px; }
        .tx-empty svg { display: block; margin: 0 auto 12px; opacity: 0.3; }

        .tx-no-results { padding: 40px 20px; text-align: center; color: #9ca3af; font-size: 13.5px; display: none; }
        .tx-no-results svg { display: block; margin: 0 auto 10px; opacity: 0.3; }

        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 200; }
        .modal-overlay.open { display: flex; }
        @keyframes modalIn { from { opacity: 0; transform: scale(0.93) translateY(8px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        .modal-box { background: #fff; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); padding: 28px; width: 340px; border: 1px solid #f0f0f2; animation: modalIn 0.2s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .modal-icon { width: 44px; height: 44px; border-radius: 12px; background: #fff1f2; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
        .modal-box h3 { font-size: 15px; font-weight: 600; color: #111827; margin: 0 0 6px; }
        .modal-box p { font-size: 13px; color: #6b7280; line-height: 1.6; margin: 0 0 22px; }
        .modal-actions { display: flex; justify-content: flex-end; gap: 10px; }
        .btn-cancel { padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 500; color: #374151; background: #f3f4f6; border: none; cursor: pointer; transition: background 0.15s; }
        .btn-cancel:hover { background: #e5e7eb; }
        .btn-confirm { padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; color: #fff; background: #ef4444; border: none; cursor: pointer; transition: background 0.15s; }
        .btn-confirm:hover { background: #dc2626; }
    </style>

    <div class="tx-wrap">
        <div class="tx-inner">
            <div class="tx-card">

                {{-- Header --}}
                <div class="tx-header">
                    {{-- Clickable calendar icon --}}
                    <div style="position:relative;">
                        <button class="tx-header-icon-btn" id="calendarBtn" onclick="togglePicker()" title="Filter by month & year">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </button>

                        {{-- Month-Year Picker --}}
                        <div class="picker-popup" id="pickerPopup">
                            <div class="picker-header">
                                <div class="picker-year-nav">
                                    <button class="picker-year-btn" onclick="changeYear(-1)">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                                    </button>
                                    <span class="picker-year-label" id="pickerYearLabel">2026</span>
                                    <button class="picker-year-btn" onclick="changeYear(1)">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                    </button>
                                </div>
                                <button class="picker-clear" onclick="clearFilter()">Clear</button>
                            </div>
                            <div class="picker-months" id="pickerMonths"></div>
                        </div>
                    </div>

                    <h2>Transactions</h2>

                    {{-- Active filter badge --}}
                    <span class="tx-filter-badge" id="filterBadge">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span id="filterBadgeText"></span>
                        <span class="tx-filter-badge-close" onclick="clearFilter()">×</span>
                    </span>
                </div>

                {{-- Success Alert --}}
                @if(session('success'))
                    <div class="tx-alert">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <table class="tx-table" id="txTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="txBody">
                        @forelse($records as $record)
                            @php $isIncome = $record->type === 'income'; @endphp
                            <tr data-date="{{ \Carbon\Carbon::parse($record->record_date)->format('Y-m') }}">
                                <td class="td-title">{{ $record->title }}</td>

                                <td>
                                    @if($isIncome)
                                        <span class="td-amount income">+₱{{ number_format($record->amount, 2) }}</span>
                                    @else
                                        <span class="td-amount expense">−₱{{ number_format($record->amount, 2) }}</span>
                                    @endif
                                </td>

                                <td>
                                    @if($isIncome)
                                        <span class="tx-badge income"><span class="dot"></span>Income</span>
                                    @else
                                        <span class="tx-badge expense"><span class="dot"></span>Expense</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="td-date">{{ \Carbon\Carbon::parse($record->record_date)->format('Y-m-d') }}</span>
                                </td>

                                <td>
                                    <div class="tx-actions">
                                        <a href="{{ route('records.edit', $record) }}" class="btn-edit">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            Edit
                                        </a>
                                        <button type="button" class="btn-delete" onclick="openDeleteModal({{ $record->id }})">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                            Delete
                                        </button>
                                        <form id="delete-form-{{ $record->id }}"
                                              action="{{ route('records.destroy', $record) }}"
                                              method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="tx-empty">
                                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/></svg>
                                        No transactions found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- No results after filter --}}
                <div class="tx-no-results" id="noResults">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    No transactions for this period.
                </div>

            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
            </div>
            <h3>Delete this record?</h3>
            <p>This is permanent and cannot be undone. The transaction will be removed from your records.</p>
            <div class="modal-actions">
                <button onclick="closeDeleteModal()" class="btn-cancel">Cancel</button>
                <button id="confirmDeleteBtn" class="btn-confirm">Yes, delete</button>
            </div>
        </div>
    </div>

    <script>
        const MONTHS = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const MONTHS_FULL = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        let pickerYear = new Date().getFullYear();
        let selectedYear = null;
        let selectedMonth = null; 

        function renderMonths() {
            const container = document.getElementById('pickerMonths');
            container.innerHTML = '';
            MONTHS.forEach((m, i) => {
                const btn = document.createElement('button');
                btn.className = 'picker-month-btn' + (selectedYear === pickerYear && selectedMonth === i ? ' selected' : '');
                btn.textContent = m;
                btn.onclick = () => selectMonth(pickerYear, i);
                container.appendChild(btn);
            });
            document.getElementById('pickerYearLabel').textContent = pickerYear;
        }

        function togglePicker() {
            const popup = document.getElementById('pickerPopup');
            const btn   = document.getElementById('calendarBtn');
            const isOpen = popup.classList.contains('open');
            if (!isOpen) {
                const rect = btn.getBoundingClientRect();
                popup.style.top  = (rect.bottom + 10) + 'px';
                popup.style.left = rect.left + 'px';
                popup.style.transform = 'none';
                renderMonths();
            }
            popup.classList.toggle('open', !isOpen);
            btn.classList.toggle('active', !isOpen);
        }

        function changeYear(delta) {
            pickerYear += delta;
            renderMonths();
        }

        function selectMonth(year, monthIndex) {
            selectedYear  = year;
            selectedMonth = monthIndex;
            applyFilter();
            closePicker();
        }

        function clearFilter() {
            selectedYear  = null;
            selectedMonth = null;
            applyFilter();
            closePicker();
        }

        function closePicker() {
            document.getElementById('pickerPopup').classList.remove('open');
            document.getElementById('calendarBtn').classList.remove('active');
        }

        function applyFilter() {
            const rows     = document.querySelectorAll('#txBody tr[data-date]');
            const badge    = document.getElementById('filterBadge');
            const badgeText = document.getElementById('filterBadgeText');
            const noResults = document.getElementById('noResults');
            const table    = document.getElementById('txTable');

            if (selectedYear === null) {
                rows.forEach(r => r.style.display = '');
                badge.classList.remove('visible');
                noResults.style.display = 'none';
                table.style.display = '';
                renderMonths();
                return;
            }

            const filter = `${selectedYear}-${String(selectedMonth + 1).padStart(2, '0')}`;
            let visible = 0;
            rows.forEach(r => {
                const show = r.dataset.date === filter;
                r.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            badgeText.textContent = `${MONTHS_FULL[selectedMonth]} ${selectedYear}`;
            badge.classList.add('visible');

            if (visible === 0) {
                noResults.style.display = 'block';
                table.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                table.style.display = '';
            }

            renderMonths();
        }

        // Close picker when clicking outside
        document.addEventListener('click', function(e) {
            const btn   = document.getElementById('calendarBtn');
            const popup = document.getElementById('pickerPopup');
            if (!btn.contains(e.target) && !popup.contains(e.target)) {
                closePicker();
            }
        });

        // Delete modal
        let deleteRecordId = null;
        function openDeleteModal(recordId) {
            deleteRecordId = recordId;
            document.getElementById('deleteModal').classList.add('open');
        }
        function closeDeleteModal() {
            deleteRecordId = null;
            document.getElementById('deleteModal').classList.remove('open');
        }
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteRecordId) {
                document.getElementById('delete-form-' + deleteRecordId).submit();
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>