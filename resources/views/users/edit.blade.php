<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="min-height: 100vh; padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
            <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="card-title">{{$title}}</h3>
            </div>
      <form method="post" action="{{url('user/update')}}">
        @csrf
        <div class="card-body">
          <div class="form-group mb-4">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$item->name}}" placeholder="Masukan nama" required />
          </div>
          <div class="form-group mb-4">
            <label for="username_input">username</label>
            <input type="text" class="form-control" name="username" id="username_input" value="{{$item->username}}" placeholder="Masukan username" required />
          </div>
          <div class="form-group mb-4">
            <label for="password" class="mb-0">Password</label>
            <p class="mb-1 font-italic">Jika ingin mengubah password, silahkan masukan password baru dibawah.</p>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password baru" />
          </div>
          <div class="form-group mb-4">
            <label for="role">Peran User</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ $item->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="owner" {{ $item->role == 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
          </div>
        </div>
        <div class="card-footer">
          <input type="hidden" name="id" value="{{$item->id}}" required />
          <a href="{{url('user')}}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </x-layout>
