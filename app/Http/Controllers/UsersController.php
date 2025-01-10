<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class UsersController extends Controller
{
    function index(){
        $collection = User::with('outlet')->get();

        return view('users.index', [
          'collection' => $collection
        ]);
      }
      function add(){
        $outlet = Outlet::all();

        return view('users.add', [
          'title' => 'Tambah User',
          'outlet' => $outlet
        ]);
      }

      function edit($id){
        $item = User::with('outlet')->find($id);
        $outlet = Outlet::all();

        if (!$item) {
          return redirect()->back()->with('message', 'Data tidak ditemukan!');
        }

        return view('users.edit', [
          'title' => 'Edit User',
          'item' => $item,
          'outlet' => $outlet

        ]);
      }

      function store(Request $req){
        try {
          $post = array_merge($req->only(['name', 'username', 'role']), [
            'password' => Hash::make($req->password)
          ]);
          User::create($post);

          return redirect(url('user'))->with('success', 'User berhasil ditambahkan!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function delete(Request $req){
        try {
          $item = User::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $item->delete();

          return redirect(url('user'))->with('success', 'User berhasil dihapus!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }

      function update(Request $req){
        try {
          $item = User::find($req->id);

          if (!$item) {
            throw new InvalidArgumentException('Data tidak ditemukan!', 500);
          }

          $post = array_merge($req->only(['name', 'username', 'role']), [
            'password' => $req->password ? Hash::make($req->password) : $item->password
          ]);

          $item->update($post);

          return redirect(url('user'))->with('success', 'User berhasil diperbarui!');

        } catch (\Throwable $th) {
          return redirect()->back()->with('message', $th->getMessage());
        }
      }
}
