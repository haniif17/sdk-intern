<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    #main-navbar {
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
    }

    #main-navbar.scrolled {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
    }

    #navbar-inner {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        max-width: 1280px;
        margin: 0 auto;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Floating pill — putih */
    #main-navbar.scrolled #navbar-inner {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 50px;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 8px 32px rgba(0,0,0,0.10), 0 2px 12px rgba(0,0,0,0.07);
        padding: 10px 24px;
        margin: 10px 24px;
        max-width: calc(100% - 48px);
    }

    .nav-link {
        color: #374151;
        font-size: 13.5px;
        font-weight: 500;
        letter-spacing: 0.4px;
        position: relative;
        padding-bottom: 4px;
        transition: color 0.2s;
        text-decoration: none;
    }
    .nav-link:hover { color: #dc2626; }
    .nav-link.active { color: #dc2626; font-weight: 700; }

    .nav-link .nav-underline {
        position: absolute; left: 0; bottom: 0;
        height: 2px; border-radius: 2px;
        background: #dc2626;
        transition: width 0.35s ease;
        width: 0;
    }
    .nav-link.active .nav-underline { width: 100%; }
    .nav-link:hover .nav-underline { width: 100%; }
</style>

<nav id="main-navbar" class="w-full sticky top-0 z-50 shadow-sm">
    <div id="navbar-inner">

        {{-- Logo --}}
        <a href="/">
            <img src="{{ asset('images/logoSDK.png') }}" alt="Logo" class="h-10">
        </a>

        {{-- Menu Desktop --}}
        <ul class="hidden md:flex items-center space-x-8">
            @foreach([
                ['/', 'HOME', '/'],
                ['/komunitas', 'KOMUNITAS', 'komunitas'],
                ['/pesan-ruangan', 'PESAN RUANGAN', 'pesan-ruangan'],
                ['/fasilitas', 'FASILITAS', 'fasilitas'],
                ['/kegiatan', 'KEGIATAN', 'kegiatan'],
                ['/hubungi-kami', 'HUBUNGI KAMI', 'hubungi-kami'],
            ] as [$href, $label, $route])
            <li>
                <a href="{{ $href }}" class="nav-link {{ request()->is($route) ? 'active' : '' }}">
                    {{ $label }}
                    <span class="nav-underline"></span>
                </a>
            </li>
            @endforeach
        </ul>

        {{-- Buttons Desktop --}}
        <div class="hidden md:flex items-center space-x-3">
            @auth
                @if(auth()->user()->role == 'komunitas' && auth()->user()->komunitas)
                    <a href="/komunitas/dashboard"
                       class="border-2 border-red-500 text-red-500 bg-white px-5 py-2 rounded-full font-semibold hover:bg-red-50 transition text-sm">
                        Edit Komunitas
                    </a>
                    <div class="flex items-center space-x-3 ml-1">
                        @if(auth()->user()->komunitas->logo)
                            <img src="{{ asset('images/komunitas/' . auth()->user()->komunitas->logo) }}"
                                 class="h-9 w-9 rounded-full object-cover border border-gray-200">
                        @endif
                        <span class="text-gray-700 font-semibold text-sm">{{ auth()->user()->komunitas->nama_komunitas }}</span>
                        <button onclick="document.getElementById('logout-form').submit()"
                                class="text-red-500 text-sm font-bold underline transition">
                            Keluar
                        </button>
                    </div>
                @else
                    <span class="text-gray-700 font-semibold text-sm">{{ auth()->user()->name }}</span>
                    <button onclick="document.getElementById('logout-form').submit()"
                            class="text-red-500 text-sm font-bold underline">
                        Keluar
                    </button>
                @endif
            @else
                <a href="/daftar-komunitas"
                   class="border-2 border-red-500 text-red-500 bg-white px-5 py-2 rounded-full font-semibold hover:bg-red-50 transition text-sm">
                    Daftar Komunitas
                </a>
                <a href="/login"
                   class="bg-red-500 text-white px-6 py-2 rounded-full font-semibold hover:bg-red-600 transition border-2 border-red-500 text-sm">
                    Masuk
                </a>
            @endauth
        </div>

        {{-- Hamburger Mobile --}}
        <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                class="md:hidden text-gray-700 hover:text-red-500 focus:outline-none transition">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden md:hidden absolute w-full bg-white border-t border-gray-100 shadow-lg top-full left-0">
        <ul class="flex flex-col py-4 px-6 space-y-4">
            <li><a href="/" class="block text-sm font-medium {{ request()->is('/') ? 'text-red-500 font-semibold' : 'text-gray-700' }}">HOME</a></li>
            <li><a href="/komunitas" class="block text-sm font-medium {{ request()->is('komunitas') ? 'text-red-500 font-semibold' : 'text-gray-700' }}">KOMUNITAS</a></li>
            <li><a href="/pesan-ruangan" class="block text-sm font-medium {{ request()->is('pesan-ruangan') ? 'text-red-500 font-semibold' : 'text-gray-700' }}">PESAN RUANGAN</a></li>
            <li><a href="/fasilitas" class="block text-sm font-medium {{ request()->is('fasilitas') ? 'text-red-500 font-semibold' : 'text-gray-700' }}">FASILITAS</a></li>
            <li><a href="/kegiatan" class="block text-sm font-medium {{ request()->is('kegiatan') ? 'text-red-500 font-semibold' : 'text-gray-700' }}">KEGIATAN</a></li>
            <li><a href="/hubungi-kami" class="block text-sm font-medium {{ request()->is('hubungi-kami') ? 'text-red-500 font-semibold' : 'text-gray-700' }}">HUBUNGI KAMI</a></li>

            <li class="pt-4 border-t border-gray-100 flex flex-col space-y-3">
                @auth
                    @if(auth()->user()->role == 'komunitas' && auth()->user()->komunitas)
                        <a href="/komunitas/dashboard"
                           class="w-full text-center border-2 border-red-500 text-red-500 px-5 py-2 rounded-full font-semibold text-sm block">
                            Edit Komunitas
                        </a>
                        <div class="flex items-center justify-center space-x-2 py-1">
                            @if(auth()->user()->komunitas->logo)
                                <img src="{{ asset('images/komunitas/' . auth()->user()->komunitas->logo) }}" class="h-8 w-8 rounded-full object-cover">
                            @endif
                            <span class="text-gray-700 font-bold text-sm">{{ auth()->user()->komunitas->nama_komunitas }}</span>
                        </div>
                        <button onclick="document.getElementById('logout-form').submit()"
                                class="w-full text-center border-2 border-red-500 text-red-500 py-2 rounded-full font-bold text-sm">
                            Keluar
                        </button>
                    @else
                        <span class="text-center font-bold text-sm text-gray-700">Halo, {{ auth()->user()->name }}</span>
                        <button onclick="document.getElementById('logout-form').submit()" class="text-red-500 font-bold text-sm">Keluar</button>
                    @endif
                @else
                    <a href="/daftar-komunitas"
                       class="w-full text-center border-2 border-red-500 text-red-500 px-5 py-2 rounded-full font-semibold text-sm block">
                        Daftar Komunitas
                    </a>
                    <a href="/login"
                       class="w-full text-center bg-red-500 text-white px-5 py-2 rounded-full font-semibold border-2 border-red-500 text-sm block">
                        Masuk
                    </a>
                @endauth
            </li>
        </ul>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
</nav>

<script>
    const navbar = document.getElementById('main-navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });
</script>