<nav x-data="{ open: false }" 
     class="bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 w-80 h-screen flex flex-col justify-between relative">

    <div class="flex flex-col flex-grow">
        <!-- Logo + Title -->
        <div class="flex items-center space-x-2 p-4">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-10 w-10">
            </a>
            <span class="font-bold text-lg text-gray-800 dark:text-gray-200">
                Financial Tracker
            </span>
        </div>

        <!-- Navigation Links -->
        <div class="flex flex-col space-y-6 px-6 mt-8">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-2">
                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('records.create')" :active="request()->routeIs('records.create')" class="px-4 py-2">
                {{ __('Add Transaction') }}
            </x-nav-link>

            <x-nav-link :href="route('records.index')" :active="request()->routeIs('records.index')" class="px-4 py-2">
                {{ __('View Transactions') }}
            </x-nav-link>

        </div>
    </div>

</nav>
