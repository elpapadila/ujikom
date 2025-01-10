<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="min-height: 100vh; padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
          <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h3 class="card-title">{{$title}}</h3>
          </div>
          <form method="post" action="{{url('user/store')}}">
            @csrf
            <div class="card-body">
              <div class="form-group mb-4">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama" required />
              </div>
              <div class="form-group mb-4">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required />
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="text" class="form-control" name="password" id="password" placeholder="Masukkan Password" required />
              </div>
              <div class="form-group mb-4">
                <label for="role">Peran</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="owner">Owner</option>
                </select>
              </div>
            </div>
            <div class="card-footer text-center">
              <a href="{{url('user')}}" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
    </div>

</x-layout>
