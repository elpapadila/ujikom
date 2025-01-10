<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Paket;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index($id)
{
    $transaksi = Transaksi::findOrFail($id); // Ambil transaksi berdasarkan ID
    $biayaTambahan = $transaksi->biaya_tambahan; // ambil biaya tambahan dari transaksi
    $pakets = Paket::all(); // Semua paket yang tersedia
    $detail = DetailTransaksi::where('id_transaksi', $id)->get(); // Ambil detail transaksi sesuai transaksi ID

    return view('detail-transaksi.index', compact('transaksi', 'pakets', 'detail', 'biayaTambahan'));
}

public function store(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'id_paket' => 'required|array',
        'qty' => 'required|array',
    ]);

    $transaksi = Transaksi::findOrFail($id); // Ambil transaksi berdasarkan ID
    $biayaTambahan = $transaksi->biaya_tambahan; // ambil biaya tambahan dari transaksi

    // Hapus semua detail sebelumnya
    DetailTransaksi::where('id_transaksi', $id)->delete();

    $totalTransaksi = 0;

    // Simpan detail transaksi baru
    foreach ($request->id_paket as $key => $id_paket) {
        // Kalkulasi total harga untuk tiap paket berdasarkan qty
        $paket = Paket::find($id_paket);
        $totalPaket = $paket->harga * $request->qty[$key];
        $totalTransaksi += $totalPaket;

        DetailTransaksi::create([
            'id_transaksi' => $id,
            'id_paket' => $id_paket,
            'qty' => $request->qty[$key],
            'total' => $totalPaket, // Total dihitung berdasarkan harga * qty
        ]);
    }
    $totalTransaksi += $biayaTambahan;
    $transaksi->update([
        'total' => $totalTransaksi,
    ]);


    // Redirect ke halaman detail transaksi yang sama
    return redirect('transaksi/detail/'. $id)->with('success', 'Detail transaksi berhasil disimpan!');
}
}
