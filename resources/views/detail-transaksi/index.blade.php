<x-layout title="Detail Transaksi">

    <div class="card shadow-lg mb-4 mx-auto" style="max-width: 800px; margin-top: 50px;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi Kode: {{$transaksi->kode_invoice}}</h6>
        </div>
        <div class="card-body">

            <!-- Form Detail Transaksi -->
            <form action="{{ url('detail-transaksi/store/'.$transaksi->id) }}" method="POST">
                @csrf

                <div id="paket-container">
                    @if($detail->isNotEmpty())
                        @foreach($detail as $d)
                            <div class="paket-row form-group">
                                <label for="id_paket[]">Pilih Paket</label>
                                <select name="id_paket[]" class="form-control paket-select">
                                    @foreach($pakets as $paket)
                                        <option value="{{ $paket->id }}"
                                            data-harga="{{ $paket->harga }}"
                                            @if($paket->id == $d->id_paket)
                                                selected
                                            @endif
                                        >{{ $paket->nama_paket }}</option>
                                    @endforeach
                                </select>

                                <label for="qty[]">Quantity</label>
                                <input type="number" name="qty[]" class="form-control qty-input" value="{{ $d->qty }}" required>

                                <label for="total[]">Total Harga</label>
                                <input type="text" name="total[]" class="form-control total-input" value="{{ $d->total }}" readonly>

                                <!-- Tombol Hapus -->
                                <button type="button" class="btn btn-danger btn-sm remove-paket-btn" style="margin-top: 5px;">Hapus</button>
                            </div>
                        @endforeach
                    @else
                        <div class="paket-row form-group">
                            <label for="id_paket[]">Pilih Paket</label>
                            <select name="id_paket[]" class="form-control paket-select">
                                @foreach($pakets as $paket)
                                    <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">{{ $paket->nama_paket }}</option>
                                @endforeach
                            </select>

                            <label for="qty[]">Quantity</label>
                            <input type="number" name="qty[]" class="form-control qty-input" value="1" required>

                            <label for="total[]">Total Harga</label>
                            <input type="text" name="total[]" class="form-control total-input" value="0" readonly>

                            <!-- Tombol Hapus -->
                            <button type="button" class="btn btn-danger btn-sm remove-paket-btn" style="margin-top: 5px;">Hapus</button>
                        </div>
                    @endif
                </div>

                <!-- Menampilkan Biaya Tambahan -->
                <div class="form-group">
                    <label for="biaya_tambahan">Biaya Tambahan</label>
                    <input type="text" id="biaya_tambahan" class="form-control" value="{{ $biayaTambahan }}" readonly>
                </div>

                <!-- Total Harga Semua Paket (Termasuk Biaya Tambahan) -->
                <div class="form-group">
                    <label for="total">Total Harga Semua Paket</label>
                    <input type="text" id="total" name="total" class="form-control" value="0" readonly>
                </div>

                <!-- Tombol -->
                <div class="form-group text-center">
                    <button type="button" class="btn btn-secondary mx-2" onclick="window.location.href='{{ url('transaksi') }}'" style="margin-right: 10px;">Kembali</button>
                    <button type="button" class="btn btn-primary mx-2" id="add-paket-btn" style="margin-right: 10px;">Tambah Paket</button>
                    <button type="submit" class="btn btn-success mx-2">Simpan Detail Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Menambahkan Paket Baru
        document.getElementById('add-paket-btn').addEventListener('click', function() {
            let newRow = document.querySelector('.paket-row').cloneNode(true);
            newRow.querySelector('.qty-input').value = 1;
            newRow.querySelector('.remove-paket-btn').style.display = 'inline-block';
            document.getElementById('paket-container').appendChild(newRow);
            updateTotal();
        });

        // Menghapus Paket
        document.getElementById('paket-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-paket-btn')) {
                e.target.closest('.paket-row').remove();
                updateTotal();
            }
        });

        // Mengupdate Total Harga Semua Paket (Dengan Biaya Tambahan)
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.paket-row').forEach(function(row) {
                let qty = row.querySelector('.qty-input').value;
                let harga = row.querySelector('.paket-select').selectedOptions[0].dataset.harga;
                total += qty * harga;
                row.querySelector('.total-input').value = qty * harga;
            });

            let biayaTambahan = parseFloat(document.getElementById('biaya_tambahan').value) || 0;
            total += biayaTambahan;

            document.getElementById('total').value = new Intl.NumberFormat().format(total);
        }

        // Update total harga ketika qty atau paket berubah
        document.getElementById('paket-container').addEventListener('input', updateTotal);
        document.getElementById('paket-container').addEventListener('change', updateTotal);

        updateTotal();
    </script>

</x-layout>
