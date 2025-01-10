
<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="min-height: 100vh; padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
            <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <form method="post" action="{{url('transaksi/store')}}">
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
                        <label for="input_kode_invoice">Kode Invoice</label>
                        <input type="text" class="form-control" name="kode_invoice" id="input_kode_invoice" value="{{ $kodeInvoice }}" readonly />
                    </div>
                    <div class="form-group mb-4">
                        <label for="id_member">Pelanggan</label>
                        <select class="form-control select2" style="width: 100%" name="id_member" id="id_member" required>
                            <option disabled value>Pilih Pelanggan</option>
                            @foreach ($customer as $c)
                                <option value="{{ $c->id }}">{{$c->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tgl">Tanggal Transaksi</label>
                        <input type="date" class="form-control" name="tgl" id="tgl" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="batas_waktu">Batas Waktu</label>
                        <input type="date" class="form-control" name="batas_waktu" id="batas_waktu" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="tgl_bayar">Tanggal Bayar</label>
                        <input type="date" class="form-control" name="tgl_bayar" id="tgl_bayar" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="baru">Baru</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Diambil</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="dibayar">Dibayar</label>
                        <select name="dibayar" id="dibayar" class="form-control" required>
                            <option value="dibayar">Dibayar</option>
                            <option value="belum dibayar">Belum Bayar</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="biaya_tambahan">Biaya Tambahan</label>
                        <input type="number" class="form-control" name="biaya_tambahan" id="biaya_tambahan" placeholder="Masukkan Biaya Tambahan"/>
                    </div>
                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                </div>
                <div class="card-footer text-center">
                    <a href="{{url('transaksi')}}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
