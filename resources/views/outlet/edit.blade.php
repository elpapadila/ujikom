<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
            <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
        <h3 class="card-title">{{$title}}</h3>
      </div>
      <form method="post" action="{{url('outlet/update')}}">
        @csrf
        <div class="card-body">
          <div class="form-group mb-4">
            <label for="nama">Nama Outlet</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama Outlet" value="{{$item->nama}}" required />
            <input type="hidden" name="id" value="{{$item->id}}" required />
          </div>
          <div class="form-group mb-4">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamat" value="{{$item->alamat}}" required />
            <input type="hidden" name="id" value="{{$item->id}}" required />
          </div>
          <div class="form-group mb-4">
            <label for="tlp">No Telp</label>
            <input type="text" class="form-control" name="tlp" id="tlp" placeholder="Masukan No Telp" value="{{$item->tlp}}" required />
            <input type="hidden" name="id" value="{{$item->id}}" required />
          </div>
        </div>
        <div class="card-footer text-center">
          <a href="{{url('outlet')}}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>

        </div>
      </form>
    </div>
    </div>
  </x-layout>
