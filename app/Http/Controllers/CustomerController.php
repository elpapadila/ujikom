<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use InvalidArgumentException;

class CustomerController extends Controller
{
    function index(){
        $collection = Customer::all();

        return view('customer.index', [
          'collection' => $collection
        ]);
      }
      function add(){
        return view('customer.add', [
          'title' => 'Tambah Data Customer'
        ]);
      }
      function edit($id){
        $item = Customer::find($id);

        if (!$item) {
          return redirect()->back()->with('message', 'Data tidak ditemukan!');
        }

        return view('customer.edit', [
          'title' => 'Edit Data Customer',
          'item' => $item
        ]);
      }
      function store(Request $req){
        try {
          $post = array_merge($req->only(['nama', 'alamat', 'jenis_kelamin', 'telp']));

          Customer::create($post);

          return redirect(url('customer'))->with('success', 'Data Customer berhasil ditambahkan!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function delete(Request $req){
        try {
          $item = Customer::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $item->delete();

          return redirect(url('customer'))->with('success', 'Data Customer berhasil dihapus!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function update(Request $req){
        try {
          $item = Customer::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $post = $req->only(['nama', 'alamat', 'jenis_kelamin', 'telp']);

          $item->update($post);

          return redirect(url('customer'))->with('success', 'Data Customer berhasil diperbarui!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }
}
