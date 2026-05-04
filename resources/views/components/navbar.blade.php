<nav class="w-full bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <div>
            <a href="/">    
                <img src="{{ asset('images/logoSDK.png') }}" alt="Logo" class="h-10">
            </a>
        </div>

        {{-- Menu --}}
        <ul class="hidden md:flex items-center space-x-10 font-light">

            {{-- HOME --}}
            <li>
                <a href="/"
                   class="relative pb-1 group
                   {{ request()->is('/') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    HOME
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out
                        {{ request()->is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                    </span>
                </a>
            </li>

            {{-- KOMUNITAS --}}
            <li>
                <a href="/komunitas"
                   class="relative pb-1 group
                   {{ request()->is('komunitas') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    KOMUNITAS
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out
                        {{ request()->is('komunitas') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                    </span>
                </a>
            </li>

            {{-- PESAN RUANGAN --}}
            <li>
                <a href="/pesan-ruangan"
                   class="relative pb-1 group
                   {{ request()->is('pesan-ruangan') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    PESAN RUANGAN
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out
                        {{ request()->is('pesan-ruangan') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                    </span>
                </a>
            </li>

            {{-- FASILITAS --}}
            <li>
                <a href="/fasilitas"
                   class="relative pb-1 group
                   {{ request()->is('fasilitas') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    FASILITAS
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out
                        {{ request()->is('fasilitas') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                    </span>
                </a>
            </li>

            {{-- KEGIATAN --}}
            <li>
                <a href="/kegiatan"
                   class="relative pb-1 group
                   {{ request()->is('kegiatan') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    KEGIATAN
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out
                        {{ request()->is('kegiatan') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                    </span>
                </a>
            </li>

            {{-- HUBUNGI --}}
            <li>
                <a href="/hubungi-kami"
                   class="relative pb-1 group
                   {{ request()->is('hubungi-kami') ? 'text-red-500 font-semibold' : 'text-gray-700 hover:text-red-500' }}">
                    HUBUNGI KAMI
                    <span class="absolute left-0 bottom-0 h-[2px] bg-red-500 transition-all duration-500 ease-out
                        {{ request()->is('hubungi-kami') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                    </span>
                </a>
            </li>

        </ul>

        {{-- Button --}}
        <a href="/login" class="bg-red-500 text-white px-4 py-2 rounded-full font-semibold hover:bg-red-600 transition">
            Masuk
        </a>

    </div>
</nav>