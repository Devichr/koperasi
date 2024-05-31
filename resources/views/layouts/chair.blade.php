<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex gap-3 p-6 bg-white">
        <div class="flex w-1/2">
            <nav>
                <ul class="flex space-x-4">
                    <li class="h-12 ease-in-out hover:border-b-4 hover:bg-gradient-to-t hover:from-slate-100 hover:to-white hover:border-blue-400 {{ request()->routeIs('chair.loans.index') ? 'font-bold border-b-4 rounded bg-gradient-to-t from-slate-100 to-white border-b-blue-400' : '' }} ">
                        <a href="{{ route('chair.loans.index') }}" class="mx-3">Pinjaman Menunggu</a>
                    </li>
                    <li class="h-12 ease-in-out hover:border-b-4 hover:bg-gradient-to-t hover:from-slate-100 hover:to-white hover:border-blue-400 {{ request()->routeIs('loans.history') ? 'font-bold border-b-4 rounded bg-gradient-to-t from-slate-100 to-white border-b-blue-400' : '' }}">
                        <a href="{{ route('loans.history') }}" class="mx-3 ">Riwayat Pinjaman</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="flex w-1/2 justify-end">
            <button onclick="toggleDropdown()" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>
                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
            <div id="dropdownMenu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.inline-flex')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('hidden')) {
                        openDropdown.classList.add('hidden');
                    }
                }
            }
        }
    </script>    <div class="container mx-auto">
        @yield('content')
    </div>
</body>
</html>
