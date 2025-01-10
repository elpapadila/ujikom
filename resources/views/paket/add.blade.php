<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="min-height: 100vh; padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
            <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <form method="post" action="{{url('paket/store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="id_outlet">Outlet</label>
                        <select class="form-control select2" style="width: 100%" name="id_outlet" id="id_outlet" required>
                            <option disabled value>Pilih Outlet</option>
                            @foreach ($outlet as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="jenis_input">Jenis</label>
                        <select name="jenis" id="jenis_input" class="form-control" required>
                            <option value="kiloan">Kiloan</option>
                            <option value="selimut">Selimut</option>
                            <option value="kaos">Kaos</option>
                            <option value="bed_cover">Bedcover</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input_nama_paket">Nama Paket</label>
                        <input type="text" class="form-control" name="nama_paket" id="input_nama_paket" placeholder="Masukkan Nama Paket" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="input_harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="input_harga" placeholder="Masukkan Harga" required />
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
