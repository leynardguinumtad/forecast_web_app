<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tailwind Icons (Heroicons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHELiMiSckEBBGpn5KaM9TZVlYGevcKTg&libraries=places">
    </script>
    <!-- Apexchart CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Include Alpine.js CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-20 bg-white border-r flex flex-col items-center py-6">
            <!-- Logo -->
            <div class="text-indigo-500 text-3xl font-bold mb-8">TS</div>

            <!-- Sidebar Icons -->
            {{-- <nav class="flex flex-col space-y-8">
                <a href="#" class="text-gray-600 hover:text-indigo-500">
                    <i class="fas fa-house-user text-xl"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-indigo-500">
                    <i class="fas fa-user-circle text-xl"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-indigo-500">
                    <i class="fas fa-chart-line text-xl"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-indigo-500">
                    <i class="fas fa-wallet text-xl"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-indigo-500">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </a>
            </nav> --}}



            <nav class="flex flex-col space-y-8">
                <div class="relative group">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-500">
                        <i class="fas fa-tachometer-alt text-xl"></i>
                    </a>
                    <span
                        class="absolute left-1/2 transform -translate-x-1/2 -translate-y-full bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        Dashboard
                    </span>
                </div>
                <div class="relative group">
                    <a href="{{ route('crud.index') }}" class="text-gray-600 hover:text-indigo-500">
                        <i class="fas fa-tasks text-xl"></i>
                    </a>
                    <span
                        class="absolute left-1/2 transform -translate-x-1/2 -translate-y-full bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        Manage Results
                    </span>
                </div>
                <div class="relative group">
                    <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-indigo-500">
                        <i class="fas fa-user-circle text-xl"></i>
                    </a>
                    <span
                        class="absolute left-1/2 transform -translate-x-1/2 -translate-y-full bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        Profile
                    </span>
                </div>
            </nav>


            <!-- Settings Icon (at bottom) -->
            <div class="mt-auto">
                <a href="#" class="text-gray-600 hover:text-indigo-500">
                    <i class="fas fa-cog text-xl"></i>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Navbar -->
            <div class="flex justify-between items-center bg-white shadow p-4 rounded-lg">
                <!-- Title -->
                <h1 class="text-lg font-semibold text-gray-700">Payments</h1>

                <!-- Search Bar -->
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search"
                        class="w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring focus:ring-indigo-200">
                </div>

                <!-- Notification and Profile -->
                <div class="flex items-center space-x-4">
                    <!-- Notification Bell -->
                    <div class="relative">
                        <a href="#" class="text-gray-600 hover:text-indigo-500">
                            <i class="fas fa-bell"></i>
                        </a>
                        <span class="absolute top-0 right-0 block h-2 w-2 bg-red-500 rounded-full"></span>
                    </div>


                    <!-- Profile Icon with Dropdown -->
                    <div class="relative">
                        <button id="profileDropdownButton"
                            class="flex items-center text-gray-600 hover:text-indigo-500 focus:outline-none">
                            <i class="fas fa-user-circle text-xl"></i>
                        </button>
                        <div id="profileDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                            <a class="block px-4 py-2 text-gray-800 hover:bg-gray-100" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="mt-6 bg-white border border-gray-200 rounded-lg h-300 flex items-center justify-center">
                @yield('content')
            </div> --}}

            <div class="mt-6 bg-white border border-gray-200 rounded-lg flex items-center justify-center p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- FontAwesome Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
        // JavaScript to toggle the dropdown
        document.getElementById('profileDropdownButton').addEventListener('click', function() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (!document.getElementById('profileDropdownButton').contains(e.target) && !dropdown.contains(e
                    .target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
