<footer class="bg-[#F4F1E8] text-gray-700 py-10 mt-20 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Kolom 1: Info Brand & Tombol Pesan --}}
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">SDK Semarang</h3>
            <p class="text-sm leading-relaxed mb-6 text-gray-600">
                Semarang Digital Kreatif (SDK) adalah coworking space dan pusat komunitas digital untuk memfasilitasi komunitas kreatif dan IT di Semarang.
            </p>
            <a href="/pesan-ruangan" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300 shadow-md">
                Pesan Ruangan
            </a>
            <a href="/daftar-komunitas" class="inline-block mt-3 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300 shadow-md">
                Daftar Komunitas
            </a>
        </div>

        {{-- Kolom 2: Link Cepat --}}
        <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Menu Cepat</h4>
            <ul class="space-y-2 text-sm text-gray-600">
                <li><a href="/" class="hover:text-red-600 transition">Beranda</a></li>
                <li><a href="/komunitas" class="hover:text-red-600 transition">Komunitas</a></li>
                <li><a href="/fasilitas" class="hover:text-red-600 transition">Fasilitas</a></li>
                <li><a href="/hubungi-kami" class="hover:text-red-600 transition">Hubungi Kami</a></li>
            </ul>
        </div>

        {{-- Kolom 3: Kontak Singkat --}}
        <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Kontak</h4>
            <ul class="space-y-2 text-sm text-gray-600">
                <li>📍 Jl. Tri Lomba Juang, Semarang</li>
                <li>📞 +62 123-456-789</li>
                <li>🕒 Buka: 08:00 - 22:00</li>
            </ul>
        </div>

    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-300 mt-10 pt-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Semarang Digital Kreatif. All rights reserved.</p>
    </div>
</footer>