<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $bulan = $request->input('bulan', now()->month); // Default bulan sekarang

        // Total Pendapatan per Outlet (Cempaka, Mawar, Amanah)
        $pendapatanPerOutlet = DB::table('tb_transaksi')
            ->join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
            ->select(DB::raw('
                tb_transaksi.id_outlet,
                SUM(tb_detail_transaksi.total) as total_pendapatan_without_biaya
            '))
            ->whereMonth('tb_transaksi.created_at', $bulan)
            ->groupBy('tb_transaksi.id_outlet')
            ->get();

        // Menambahkan Biaya Tambahan per Outlet setelah menghitung total pendapatan
        foreach ($pendapatanPerOutlet as $outlet) {
            $outlet->total_pendapatan = $outlet->total_pendapatan_without_biaya + $this->getBiayaTambahan($outlet->id_outlet, $bulan);
        }

        // Menambahkan data outlet yang tidak ada (Mawar misalnya)
        $outlets = [2 => 'Cempaka', 3 => 'Mawar', 4 => 'Amanah'];
        foreach ($outlets as $id => $name) {
            if (!$pendapatanPerOutlet->where('id_outlet', $id)->first()) {
                $pendapatanPerOutlet->push((object) [
                    'id_outlet' => $id,
                    'total_pendapatan' => 0
                ]);
            }
        }

        // Jumlah Transaksi per Outlet
        $jumlahTransaksiPerOutlet = DB::table('tb_transaksi')
            ->select(DB::raw('
                tb_transaksi.id_outlet,
                COUNT(tb_transaksi.id) as jumlah_transaksi
            '))
            ->whereMonth('tb_transaksi.created_at', $bulan)
            ->groupBy('tb_transaksi.id_outlet')
            ->get();

        // Pendapatan per Paket
        $pendapatanPerPaket = DB::table('tb_paket')
            ->join('tb_detail_transaksi', 'tb_paket.id', '=', 'tb_detail_transaksi.id_paket')
            ->join('tb_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
            ->select(DB::raw('
                tb_paket.nama_paket,
                SUM(tb_detail_transaksi.total) as total_pendapatan_without_biaya
            '))
            ->whereMonth('tb_transaksi.created_at', $bulan)
            ->groupBy('tb_paket.id')
            ->get();

        // Menambahkan Biaya Tambahan per Paket
        foreach ($pendapatanPerPaket as $paket) {
            $paket->total_pendapatan = $paket->total_pendapatan_without_biaya + $this->getBiayaTambahanPaket($paket->nama_paket, $bulan);
        }

        // Jumlah Member Baru
        $jumlahCustomerBaru = DB::table('tb_member')
            ->whereMonth('created_at', $bulan)
            ->count();

        // Biaya Tambahan Total
        $biayaTambahanTotal = DB::table('tb_transaksi')
            ->whereMonth('created_at', $bulan)
            ->sum('biaya_tambahan');

        // Total Pendapatan dari semua outlet
        $totalPendapatanAllOutlet = $pendapatanPerOutlet->sum('total_pendapatan');

        // Generate PDF menggunakan view 'report.pendapatan'
        $pdf = Pdf::loadView('report.pendapatan', compact(
            'pendapatanPerOutlet', 'pendapatanPerPaket', 'jumlahTransaksiPerOutlet',
            'jumlahCustomerBaru', 'biayaTambahanTotal', 'bulan', 'totalPendapatanAllOutlet'
        ))->setPaper('a4', 'potrait'); // Mengatur ukuran kertas dan orientasi potrait

        // Menampilkan PDF di browser (preview)
        return $pdf->stream('laporan-pendapatan-bulanan.pdf');
    }

    // Function untuk mengambil biaya tambahan berdasarkan outlet dan bulan
    private function getBiayaTambahan($id_outlet, $bulan)
    {
        return DB::table('tb_transaksi')
            ->where('id_outlet', $id_outlet)
            ->whereMonth('created_at', $bulan)
            ->sum('biaya_tambahan');
    }

    // Function untuk mengambil biaya tambahan berdasarkan paket dan bulan
    private function getBiayaTambahanPaket($nama_paket, $bulan)
    {
        return DB::table('tb_transaksi')
            ->join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
            ->where('tb_detail_transaksi.id_paket', $nama_paket)
            ->whereMonth('tb_transaksi.created_at', $bulan)
            ->sum('biaya_tambahan');
    }
}
