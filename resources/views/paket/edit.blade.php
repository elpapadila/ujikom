<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="min-height: 100vh; padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
            <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <form method="post" action="{{url('paket/update')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="id_outlet">Outlet</label>
                        <select class="form-control select2" style="width: 100%" name="id_outlet" id="id_outlet" required>
                            <option disabled value>Pilih Outlet</option>
                            @foreach ($outlet as $o)
                                <option value="{{$o->id}}" {{ $item->id_outlet == $o->id ? 'selected' : '' }}>{{$o->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control" required>
                            <option value="kiloan" {{ $item->jenis == 'kiloan' ? 'selected' : '' }}>Kiloan</option>
                            <option value="selimut" {{ $item->jenis == 'selimut' ? 'selected' : '' }}>Selimut</option>
                            <option value="kaos" {{ $item->jenis == 'kaos' ? 'selected' : '' }}>Kaos</option>
                            <option value="bed_cover" {{ $item->jenis == 'bed_cover' ? 'selected' : '' }}>Bedcover</option>
                            <option value="lainnya" {{ $item->jenis == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="nama_paket">Nama Paket</label>
                        <input type="text" class="form-control" name="nama_paket" id="nama_paket" placeholder="Masukkan Nama Paket" value="{{$item->nama_paket}}" required />
                        <input type="hidden" name="id" value="{{$item->id}}" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukkan Harga" value="{{$item->harga}}" required />
                        <input type="hidden" name="id" value="{{$item->id}}" required />
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{url('paket')}}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
