<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="min-height: 100vh; padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
          <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h3 class="card-title">{{$title}}</h3>
          </div>
          <form method="post" action="{{url('customer/store')}}">
            @csrf
            <div class="card-body">
              <div class="form-group mb-4">
                <label for="nama">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Pelanggan" required />
              </div>
              <div class="form-group mb-4">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat" rows="3" required></textarea>
              </div>
              <div class="form-group mb-4">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group mb-4">
                <label for="telp">No Telp</label>
                <input type="text" class="form-control" name="telp" id="telp" placeholder="Masukkan Nomor Telepon" required />
              </div>
            </div>
            <div class="card-footer text-center">
              <a href="{{url('customer')}}" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
    </div>

</x-layout>
