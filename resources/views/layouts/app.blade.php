<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Restoran</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "{{ route('menu.index') }}";
            });
        </script>
    @endif

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div id="app">
        <nav class="bg-white shadow">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <a class="text-lg font-bold text-gray-700" href="{{ url('/') }}">
                        Restoran
                    </a>
                    <div class="flex items-center space-x-4">
                        @auth <!-- Periksa apakah pengguna sedang login -->
                            @if(auth()->user()->role == 0) <!-- Hanya untuk pengguna dengan role 0 -->
                                <a href="{{ url('/menus') }}" class="text-blue-700 font-semibold hover:text-blue-900">Menu</a>
                                <a href="{{ url('/kategoris') }}" class="text-blue-700 font-semibold hover:text-blue-900">Kategoris</a>
                            @endif
                            <a href="{{ url('/daftar-menu') }}" class="text-blue-700 font-semibold hover:text-blue-900">Daftar Menu</a>
                        @endauth
                    
                        {{-- @guest <!-- Tampilkan opsi untuk tamu -->
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            @endif
                    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
                            @endif
                        @endguest --}}
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
                            @endif
                        @else
                        <div class="relative">
    <button 
        id="userDropdownButton" 
        class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none"
        onclick="toggleDropdown()"
    >
        {{ Auth::user()->name }}
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div 
        id="userDropdownMenu"   
        class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-20 hidden"
    >
        <a href="{{ route('logout') }}" 
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    // Menutup dropdown jika klik di luar
    document.addEventListener('click', function(event) {
        const dropdownButton = document.getElementById('userDropdownButton');
        const dropdownMenu = document.getElementById('userDropdownMenu');

        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
