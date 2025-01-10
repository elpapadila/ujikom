<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;
use InvalidArgumentException;

class PaketController extends Controller
{
    function index(){
        $collection = Paket::with('outlet')->get();

        return view('paket.index', [
          'collection' => $collection
        ]);
      }
      function add(){
        $outlet = Outlet::all();
        return view('paket.add', [
          'title' => 'Tambah Paket Cucian',
          'outlet' => $outlet
        ]);
      }
      function edit($id){
        $outlet = Outlet::all();
        $item = Paket::with('outlet')->find($id);

        if (!$item) {
          return redirect()->back()->with('message', 'Data tidak ditemukan!');
        }

        return view('paket.edit', [
          'title' => 'Edit Data paket',
          'item' => $item,
          'outlet' => $outlet

        ]);
      }
      function store(Request $req){
        try {
          $post = array_merge($req->only(['id_outlet', 'jenis', 'nama_paket', 'harga']));

          Paket::create($post);

          return redirect(url('paket'))->with('success', 'Data Paket Cucian berhasil ditambahkan!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function delete(Request $req){
        try {
          $item = Paket::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $item->delete();

          return redirect(url('paket'))->with('success', 'Data Paket Cucian berhasil dihapus!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function update(Request $req){
        try {
          $item = Paket::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $post = $req->only(['id_outlet', 'jenis', 'nama_paket', 'harga']);

          $item->update($post);

          return redirect(url('paket'))->with('success', 'Data Paket Cucian berhasil diperbarui!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }
}
