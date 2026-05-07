<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&display=swap');

        .form-wrap { display: flex; justify-content: center; margin-top: 40px; padding: 0 16px 48px; }
        .form-card { width: 100%; max-width: 480px; background: #fff; border-radius: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #f0f0f2; overflow: hidden; }

        .form-header { display: flex; align-items: center; gap: 12px; padding: 22px 28px; border-bottom: 1px solid #f0f0f2; }
        .form-header-icon { width: 36px; height: 36px; border-radius: 10px; background: #fef3c7; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .form-header h2 { font-size: 15px; font-weight: 600; color: #111827; margin: 0; }

        .form-body { padding: 24px 28px; }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12.5px; font-weight: 600; color: #374151; margin-bottom: 7px; letter-spacing: 0.01em; }

        .form-input,
        .form-select { width: 100%; border: 1px solid #e5e7eb; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; color: #111827; background: #fff; outline: none; box-sizing: border-box; transition: border-color 0.15s, box-shadow 0.15s; }
        .form-input:focus,
        .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,0.1); }

        .form-select { cursor: pointer; }

        .btn-submit { width: 100%; padding: 11px 0; background: #f59e0b; color: #fff; font-size: 13.5px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; margin-top: 4px; transition: background 0.15s; box-shadow: 0 1px 3px rgba(245,158,11,0.3); }
        .btn-submit:hover { background: #d97706; }
    </style>

    <div class="form-wrap">
        <div class="form-card">

            <div class="form-header">
                <div class="form-header-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <h2>Edit Transaction</h2>
            </div>

            <div class="form-body">
                <form method="POST" action="{{ route('records.update', $record) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="type" class="form-select" required>
                            <option value="income"  {{ $record->type === 'income'  ? 'selected' : '' }}>Income</option>
                            <option value="expense" {{ $record->type === 'expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <input type="text" name="title" class="form-input" value="{{ old('title', $record->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Amount (₱)</label>
                        <input type="number" step="0.01" name="amount" class="form-input" value="{{ old('amount', $record->amount) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="record_date" class="form-input"
                               value="{{ old('record_date', $record->record_date ? \Carbon\Carbon::parse($record->record_date)->format('Y-m-d') : '') }}"
                               required>
                    </div>

                    <button type="submit" class="btn-submit">Update Transaction</button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>