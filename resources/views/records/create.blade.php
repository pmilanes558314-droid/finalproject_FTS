<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&display=swap');

        .form-wrap { display: flex; justify-content: center; margin-top: 40px; padding: 0 16px 48px; }
        .form-card { width: 100%; max-width: 480px; background: #fff; border-radius: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #f0f0f2; overflow: hidden; }

        .form-header { display: flex; align-items: center; gap: 12px; padding: 22px 28px; border-bottom: 1px solid #f0f0f2; }
        .form-header-icon { width: 36px; height: 36px; border-radius: 10px; background: #eff6ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .form-header h2 { font-size: 15px; font-weight: 600; color: #111827; margin: 0; }

        .form-body { padding: 24px 28px; }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12.5px; font-weight: 600; color: #374151; margin-bottom: 7px; letter-spacing: 0.01em; }

        .form-input,
        .form-select { width: 100%; border: 1px solid #e5e7eb; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; color: #111827; background: #fff; outline: none; box-sizing: border-box; transition: border-color 0.15s, box-shadow 0.15s; }
        .form-input:focus,
        .form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }

        .form-select { cursor: pointer; }

        .btn-submit { width: 100%; padding: 11px 0; background: #2563eb; color: #fff; font-size: 13.5px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; margin-top: 4px; transition: background 0.15s; box-shadow: 0 1px 3px rgba(37,99,235,0.3); }
        .btn-submit:hover { background: #1d4ed8; }
    </style>

    <div class="form-wrap">
        <div class="form-card">

            <div class="form-header">
                <div class="form-header-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </div>
                <h2>Add Transaction</h2>
            </div>

            <div class="form-body">
                <form method="POST" action="{{ route('records.store') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="type" class="form-select" required>
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <input type="text" name="title" class="form-input" placeholder="e.g. Monthly salary" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Amount (₱)</label>
                        <input type="number" step="0.01" name="amount" class="form-input" placeholder="0.00" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="record_date" class="form-input" required>
                    </div>

                    <button type="submit" class="btn-submit">Save Transaction</button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>