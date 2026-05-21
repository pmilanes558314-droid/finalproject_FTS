<x-app-layout>
    <div style="display:flex; justify-content:center; padding:2rem;">
        <div style="flex:1; max-width:1000px; margin:0 auto;">

            <h2 style="font-size:2rem; font-weight:bold; margin-bottom:1.5rem; text-align:center;">
                Admin Dashboard
            </h2>

            <p style="text-align:center; color:#555; margin-bottom:2rem;">
                Welcome, {{ Auth::user()->name }}. You have administrator access.
            </p>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:1.5rem;">
                <div style="background:#f9f9f9; padding:1.5rem; border-radius:8px; 
                            box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:center;">
                    <h3 style="font-size:1.25rem; font-weight:600; color:#333;">Manage Users</h3>
                    <p style="font-size:0.9rem; color:#666; margin:0.75rem 0 1.25rem;">
                        View and manage registered users.
                    </p>
                    <a href="{{ route('users.index') }}" 
                       style="background:linear-gradient(to right, #1e88e5, #1565c0); 
                              color:#fff; padding:0.5rem 1.25rem; border-radius:6px; 
                              text-decoration:none; font-weight:bold; 
                              transition:background 0.3s ease;">
                        Go to Users
                    </a>
                </div>

                <div style="background:#f9f9f9; padding:1.5rem; border-radius:8px; 
                            box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:center;">
                    <h3 style="font-size:1.25rem; font-weight:600; color:#333;">Transactions</h3>
                    <p style="font-size:0.9rem; color:#666; margin:0.75rem 0 1.25rem;">
                        Monitor all financial records.
                    </p>
                    <a href="{{ route('admin.records') }}" 
                       style="background:linear-gradient(to right, #43a047, #2e7d32); 
                              color:#fff; padding:0.5rem 1.25rem; border-radius:6px; 
                              text-decoration:none; font-weight:bold; 
                              transition:background 0.3s ease;">
                        View Records
                    </a>
                </div>
            </div>

            <div style="margin-top:2rem; font-size:0.9rem; color:#777; text-align:center;">
                Last login: {{ Auth::user()->last_login_at ?? now() }}
            </div>
        </div>
    </div>
</x-app-layout>
