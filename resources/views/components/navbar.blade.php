<nav class="w-full bg-white shadow-sm sticky top-0 z-50 relative">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <div>
            <a href="/">    
                <img src="{{ asset('images/logoSDK.png') }}" alt="Logo" class="h-10">
            </a>
        </div>

        {{-- Menu (Desktop) --}}
        <ul class="hidden md:flex items-center space-x-10 font-light">
            <li>
                <a href="/" class="relative pb-1 group {{ request()->is('/') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    HOME
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out {{ request()->is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="/komunitas" class="relative pb-1 group {{ request()->is('komunitas') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    KOMUNITAS
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out {{ request()->is('komunitas') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="/pesan-ruangan" class="relative pb-1 group {{ request()->is('pesan-ruangan') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    PESAN RUANGAN
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out {{ request()->is('pesan-ruangan') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="/fasilitas" class="relative pb-1 group {{ request()->is('fasilitas') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    FASILITAS
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out {{ request()->is('fasilitas') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="/kegiatan" class="relative pb-1 group {{ request()->is('kegiatan') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    KEGIATAN
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out {{ request()->is('kegiatan') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="/hubungi-kami" class="relative pb-1 group {{ request()->is('hubungi-kami') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    HUBUNGI KAMI
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out {{ request()->is('hubungi-kami') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
        </ul>

        {{-- Buttons Group (Desktop) --}}
        <div class="hidden md:flex items-center space-x-3">
            @auth
                @if(auth()->user()->role == 'komunitas' && auth()->user()->komunitas)
                    <a href="/komunitas/dashboard" class="border-2 border-red-500 text-red-500 bg-white px-5 py-2 rounded-full font-semibold hover:bg-red-50 transition shadow-sm">
                        Edit Komunitas
                    </a>
                    
                    <div class="flex items-center space-x-3 ml-2">
                        @if(auth()->user()->komunitas->logo)
                            <img src="{{ asset('images/komunitas/' . auth()->user()->komunitas->logo) }}" alt="Logo" class="h-9 w-9 rounded-full object-cover border border-gray-200">
                        @endif
                        <span class="text-gray-700 font-semibold">{{ auth()->user()->komunitas->nama_komunitas }}</span>
                        
                        {{-- Tombol Logout Desktop --}}
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-500 hover:text-red-700 text-sm font-bold ml-2 underline transition">
                            Keluar
                        </button>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700 font-semibold">{{ auth()->user()->name }}</span>
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-500 text-sm font-bold underline">
                            Keluar
                        </button>
                    </div>
                @endif
            @else
                <a href="/daftar-komunitas" class="border-2 border-red-500 text-red-500 bg-white px-5 py-2 rounded-full font-semibold hover:bg-red-50 transition shadow-sm">
                    Daftar Komunitas 
                </a>
                <a href="/login" class="bg-red-500 text-white px-6 py-2 rounded-full font-semibold hover:bg-red-600 transition shadow-sm border-2 border-red-500">
                    Masuk
                </a>
            @endauth
        </div>

        {{-- Hamburger Button (Mobile) --}}
        <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="md:hidden text-gray-700 hover:text-red-500 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

    </div>

    {{-- ================= MENU MOBILE (Dropdown) ================= --}}
    <div id="mobileMenu" class="hidden md:hidden absolute w-full bg-white border-t border-gray-100 shadow-lg top-full left-0">
        <ul class="flex flex-col py-4 px-6 space-y-4 font-light">
            <li><a href="/" class="block {{ request()->is('/') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">HOME</a></li>
            <li><a href="/komunitas" class="block {{ request()->is('komunitas') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">KOMUNITAS</a></li>
            <li><a href="/pesan-ruangan" class="block {{ request()->is('pesan-ruangan') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">PESAN RUANGAN</a></li>
            <li><a href="/fasilitas" class="block {{ request()->is('fasilitas') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">FASILITAS</a></li>
            <li><a href="/kegiatan" class="block {{ request()->is('kegiatan') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">KEGIATAN</a></li>
            <li><a href="/hubungi-kami" class="block {{ request()->is('hubungi-kami') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">HUBUNGI KAMI</a></li>
            
            <li class="pt-4 border-t border-gray-100 flex flex-col space-y-3">
                @auth
                    @if(auth()->user()->role == 'komunitas' && auth()->user()->komunitas)
                        <a href="/komunitas/dashboard" class="inline-block w-full text-center border-2 border-red-500 text-red-500 bg-white px-5 py-2 rounded-full font-semibold">
                            Edit Komunitas
                        </a>
                        <div class="flex items-center justify-center space-x-2 py-2">
                            @if(auth()->user()->komunitas->logo)
                                <img src="{{ asset('images/komunitas/' . auth()->user()->komunitas->logo) }}" class="h-8 w-8 rounded-full object-cover">
                            @endif
                            <span class="text-gray-700 font-bold">{{ auth()->user()->komunitas->nama_komunitas }}</span>
                        </div>
                        {{-- Logout Mobile --}}
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full text-center bg-gray-100 text-red-500 py-2 rounded-full font-bold">
                            Keluar
                        </button>
                    @else
                        <span class="text-center font-bold">Halo, {{ auth()->user()->name }}</span>
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-500 font-bold">Keluar</button>
                    @endif
                @else
                    <a href="/daftar-komunitas" class="inline-block w-full text-center border-2 border-red-500 text-red-500 bg-white px-5 py-2 rounded-full font-semibold">
                        Daftar Komunitas
                    </a>    
                    <a href="/login" class="inline-block w-full text-center bg-red-500 text-white px-5 py-2 rounded-full font-semibold border-2 border-red-500">
                        Masuk
                    </a>
                @endauth
            </li>
        </ul>
    </div>

    {{-- Form Logout Hidden --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</nav>