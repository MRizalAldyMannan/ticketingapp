<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Ticketing</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="fixed top-0 right-0 px-6 py-4 sm:block z-50">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                        @if(auth()->user()->isAdmin())
                             <a href="{{ route('admin.dashboard') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Admin Panel</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Discover Amazing Events</h1>
                    <p class="text-gray-600">Book your tickets now and create memories.</p>
                </div>

                <!-- Search & Filter -->
                <div class="mb-8">
                    <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-4 justify-center">
                        <input type="text" name="search" placeholder="Search events..." value="{{ request('search') }}" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-1/3">
                        <select name="category" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-1/4">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Search</button>
                    </form>
                </div>

                <!-- Events Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($events as $event)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                             @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-500">
                                    No Image
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full uppercase font-semibold tracking-wide">{{ $event->category->name }}</span>
                                    <span class="text-sm text-gray-500">{{ $event->start_time->format('M d') }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">${{ number_format($event->price, 2) }}</span>
                                    <a href="{{ route('events.show', $event->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">View Details &rarr;</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-gray-500 py-12">
                            No events found matching your criteria.
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-8">
                    {{ $events->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </body>
</html>
