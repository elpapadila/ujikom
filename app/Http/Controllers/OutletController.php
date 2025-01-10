<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use InvalidArgumentException;

class OutletController extends Controller
{
    function index(){
        $collection = Outlet::all();

        return view('outlet.index', [
          'collection' => $collection
        ]);
      }
      function add(){
        return view('outlet.add', [
          'title' => 'Tambah Data outlet'
        ]);
      }
      function edit($id){
        $item = Outlet::find($id);

        if (!$item) {
          return redirect()->back()->with('message', 'Data tidak ditemukan!');
        }

        return view('outlet.edit', [
          'title' => 'Edit Data outlet',
          'item' => $item
        ]);
      }
      function store(Request $req){
        try {
          $post = array_merge($req->only(['nama', 'alamat', 'tlp']));

          Outlet::create($post);

          return redirect(url('outlet'))->with('success', 'Data outlet berhasil ditambahkan!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function delete(Request $req){
        try {
          $item = Outlet::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $item->delete();

          return redirect(url('outlet'))->with('success', 'Data outlet berhasil dihapus!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function update(Request $req){
        try {
          $item = Outlet::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $post = $req->only(['nama', 'alamat', 'tlp']);

          $item->update($post);

          return redirect(url('outlet'))->with('success', 'Data outlet berhasil diperbarui!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }
}
