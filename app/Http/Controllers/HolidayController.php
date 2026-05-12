<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use Illuminate\Support\Carbon;

class HolidayController extends Controller
{
    public function storeBulk(Request $request)
    {
        $request->validate([
            'data_libur' => 'required'
        ]);

        // Memecah berdasarkan baris baru
        $baris = explode("\n", $request->data_libur);
        $berhasil = 0;

        foreach ($baris as $item) {
            // Memecah berdasarkan garis miring (/) 
            // Format yang diharapkan: 17-08-2026/Hari Kemerdekaan
            $data = explode("/", $item);

            if (count($data) >= 2) {
                $tanggalInput = trim($data[0]); // Mengambil "17-08-2026"
                $keterangan = trim($data[1]);  // Mengambil "Hari Kemerdekaan"

                try {
                    // Konversi format DD-MM-YYYY ke YYYY-MM-DD untuk database
                    $fullDate = Carbon::createFromFormat('d-m-Y', $tanggalInput)->format('Y-m-d');

                    Holiday::updateOrCreate(
                        ['tanggal' => $fullDate],
                        ['keterangan' => $keterangan]
                    );
                    $berhasil++;
                } catch (\Exception $e) {
                    continue; // Lewati jika format tanggal atau string salah
                }
            }
        }

        return back()->with('success', "$berhasil data hari libur berhasil diproses dengan format baru!");
    }

    public function destroy($id)
    {
        Holiday::findOrFail($id)->delete();
        return back()->with('success', 'Hari libur berhasil dihapus.');
    }
}