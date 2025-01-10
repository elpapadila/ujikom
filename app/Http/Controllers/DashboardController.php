<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();

    // Query untuk total pendapatan (langsung dari detail transaksi + biaya tambahan)
    $totalPendapatan = Transaksi::join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
        ->select(DB::raw('SUM(tb_detail_transaksi.total) + SUM(DISTINCT tb_transaksi.biaya_tambahan) as total_pendapatan'))
        ->first();

    // Pendapatan per outlet
    $pendapatanCempaka = Transaksi::join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
        ->where('tb_transaksi.id_outlet', 2)
        ->select(DB::raw('SUM(tb_detail_transaksi.total) + SUM(DISTINCT tb_transaksi.biaya_tambahan) as total_pendapatan'))
        ->first();

    $pendapatanMawar = Transaksi::join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
        ->where('tb_transaksi.id_outlet', 3)
        ->select(DB::raw('SUM(tb_detail_transaksi.total) + SUM(DISTINCT tb_transaksi.biaya_tambahan) as total_pendapatan'))
        ->first();

    $pendapatanAmanah = Transaksi::join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
        ->where('tb_transaksi.id_outlet', 4)
        ->select(DB::raw('SUM(tb_detail_transaksi.total) + SUM(DISTINCT tb_transaksi.biaya_tambahan) as total_pendapatan'))
        ->first();

    // Ambil id_outlet dari parameter URL (opsional jika tidak ada, tampilkan seluruh data)
    $id_outlet = $request->get('id_outlet');

    // Query transaksi berdasarkan outlet, jika id_outlet ada, filter berdasarkan outlet tersebut
    $transaksi = Transaksi::join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
        ->when($id_outlet, function ($query) use ($id_outlet) {
            return $query->where('tb_transaksi.id_outlet', $id_outlet);
        })
        ->select('tb_transaksi.kode_invoice', 'tb_transaksi.created_at as tanggal', 'tb_detail_transaksi.total as jumlah')
        ->get();

    // Ambil jumlah cucian berdasarkan status
    $baru = Transaksi::where('status', 'baru')->count();
    $selesai = Transaksi::where('status', 'selesai')->count();
    $diambil = Transaksi::where('status', 'diambil')->count();
    $proses = Transaksi::where('status', 'proses')->count();

    // Mendapatkan bulan yang dipilih dari request
$bulan = request('bulan') ?? now()->month;  // Default ke bulan saat ini jika tidak ada filter bulan

// Ambil data pendapatan bulanan berdasarkan bulan yang dipilih
$pendapatanBulanan = DB::table('tb_transaksi')
    ->join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
    ->select(DB::raw('MONTH(tb_transaksi.created_at) as bulan,
                      SUM(CASE WHEN tb_transaksi.id_outlet = 2 THEN tb_detail_transaksi.total ELSE 0 END) as cempaka,
                      SUM(CASE WHEN tb_transaksi.id_outlet = 3 THEN tb_detail_transaksi.total ELSE 0 END) as mawar,
                      SUM(CASE WHEN tb_transaksi.id_outlet = 4 THEN tb_detail_transaksi.total ELSE 0 END) as amanah'))
    ->whereMonth('tb_transaksi.created_at', $bulan)  // Filter berdasarkan bulan yang dipilih
    ->groupBy(DB::raw('MONTH(tb_transaksi.created_at)'))
    ->get();

    return view('dashboard', compact('user', 'totalPendapatan', 'pendapatanCempaka', 'pendapatanMawar', 'pendapatanAmanah', 'baru', 'selesai', 'diambil', 'proses', 'pendapatanBulanan', 'bulan', 'transaksi'));
}

}
