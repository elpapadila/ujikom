<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use InvalidArgumentException;

class TransaksiController extends Controller
{
    public function index($id_outlet = null)
    {
        // Jika ada id_outlet, filter berdasarkan outlet
        if ($id_outlet) {
            $collection = Transaksi::where('id_outlet', $id_outlet)
                ->with('outlet', 'customer') // Pastikan relasi outlet dan customer di-load
                ->get();
        } else {
            // Tampilkan semua transaksi jika tidak ada id_outlet
            $collection = Transaksi::with('outlet', 'customer')->get();
        }

        return view('transaksi.index', [
            'collection' => $collection
        ]);
    }

    public function add()
    {
        $outlet = Outlet::all();
        $customer = Customer::all();
        $kodeInvoice = 'INV-' . uniqid();

        Log::info("Method add dijalankan");
        return view('transaksi.add', [
            'title' => 'Tambah Data Transaksi',
            'outlet' => $outlet,
            'customer' => $customer,
            'kodeInvoice' => $kodeInvoice,
        ]);
    }

    public function edit($id)
    {
        $outlet = Outlet::all();
        $customer = Customer::all();
        $item = Transaksi::with('outlet', 'customer')->find($id);

        if (!$item) {
            return redirect()->back()->with('message', 'Data tidak ditemukan!');
        }
        $kodeInvoice = $item->kode_invoice;

        return view('transaksi.edit', [
            'title' => 'Edit Data Transaksi',
            'item' => $item,
            'outlet' => $outlet,
            'customer' => $customer,
            'kodeInvoice' => $kodeInvoice,

        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'id_outlet' => 'required',
            'kode_invoice' => 'required',
            'id_member' => 'required',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date',
            'tgl_bayar' => 'nullable|date',
            'status' => 'required',
            'dibayar' => 'required',
            'biaya_tambahan' => 'numeric|min:0',
        ]);

        try {
            $post = array_merge($req->only(['id_outlet', 'kode_invoice', 'id_member', 'tgl', 'batas_waktu', 'tgl_bayar', 'status', 'dibayar', 'biaya_tambahan']), ['id_user' => $req->id_user]);

            Transaksi::create($post);

            return redirect(url('transaksi'))->with('success', 'Entri Data Transaksi berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Gagal menambahkan data: ' . $th->getMessage());
        }
    }

    public function delete(Request $req)
    {
        try {
            $item = Transaksi::find($req->id);

            if (!$item) {
                throw new InvalidArgumentException('Data tidak ditemukan!', 500);
            }

            $item->delete();

            return redirect(url('transaksi'))->with('success', 'Entri Data Transaksi berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }

    public function update(Request $req)
    {
        $req->validate([
            'id_outlet' => 'required',
            'kode_invoice' => 'required',
            'id_member' => 'required',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date',
            'tgl_bayar' => 'nullable|date',
            'status' => 'required',
            'dibayar' => 'required',
            'biaya_tambahan' => 'numeric|min:0',
        ]);

        try {
            $item = Transaksi::find($req->id);

            if (!$item) {
                throw new InvalidArgumentException('Data tidak ditemukan!', 500);
            }

            $post = $req->only(['id_outlet', 'kode_invoice', 'id_member', 'tgl', 'batas_waktu', 'tgl_bayar', 'status', 'dibayar', 'id_user', 'biaya_tambahan']);

            $item->update($post);

            return redirect(url('transaksi'))->with('success', 'Entri Data Transaksi berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }
}
