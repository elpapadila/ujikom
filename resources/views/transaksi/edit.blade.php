<x-layout title="{{$title}}">

    <div class="d-flex justify-content-center" style="min-height: 100vh; padding-top: 20px; padding-bottom: 50px;">
        <div class="card card-primary shadow-lg" style="max-width: 700px; width: 100%; border-radius: 10px;">
            <div class="card-header bg-primary text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <form method="post" action="{{url('transaksi/update')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="id_outlet">Outlet</label>
                        <select class="form-control select2" style="width: 100%" name="id_outlet" id="id_outlet" required>
                            <option disabled value>Pilih Outlet</option>
                            @foreach ($outlet as $o)
                                <option value="{{$o->id}}" {{ $o->id == $item->id_outlet ? 'selected' : '' }}>{{$o->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input_kode_invoice">Kode Invoice</label>
                        <input type="text" class="form-control" name="kode_invoice" id="input_kode_invoice" placeholder="Masukkan Kode Invoice" value="{{ $kodeInvoice }}" readonly />
                    </div>
                    <div class="form-group mb-4">
                        <label for="id_member">Pelanggan</label>
                        <select class="form-control select2" style="width: 100%" name="id_member" id="id_member" required>
                            <option disabled value>Pilih Pelanggan</option>
                            @foreach ($customer as $c)
                                <option value="{{ $c->id }}" {{ $c->id == $item->id_member ? 'selected' : '' }}>{{$c->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tgl">Tanggal Transaksi</label>
                        <input type="date" class="form-control" name="tgl" id="tgl" value="{{date('Y-m-d', strtotime(str_replace('-', '/', $item->tgl)))}}" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="batas_waktu">Batas Waktu</label>
                        <input type="date" class="form-control" name="batas_waktu" id="batas_waktu" value="{{date('Y-m-d', strtotime(str_replace('-', '/', $item->batas_waktu)))}}" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="tgl_bayar">Tanggal Bayar</label>
                        <input type="date" class="form-control" name="tgl_bayar" id="tgl_bayar" value="{{ $item->tgl_bayar ? date('Y-m-d', strtotime($item->tgl_bayar)) : '' }}" />
                    </div>
                    <div class="form-group mb-4">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="baru" {{ $item->status == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="diambil" {{ $item->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="dibayar">Dibayar</label>
                        <select name="dibayar" id="dibayar" class="form-control" required>
                            <option value="dibayar" {{ $item->dibayar == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="belum dibayar" {{ $item->dibayar == 'belum dibayar' ? 'selected' : '' }}>Belum Bayar</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="biaya_tambahan">Biaya Tambahan</label>
                        <input type="number" class="form-control" name="biaya_tambahan" id="biaya_tambahan" placeholder="Masukkan Biaya Tambahan" value="{{$item->biaya_tambahan}}" />
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
