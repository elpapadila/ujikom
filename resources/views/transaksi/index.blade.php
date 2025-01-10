<x-layout title="Data Transaksi">

    <!-- Page Heading -->
    <div class="card-header border-0 mb-1">
        <a href="{{url('transaksi/add')}}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Transaksi
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>Outlet</th>
                            <th>Kode Invoice</th>
                            <th>Pelanggan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Batas Waktu</th>
                            <th>Tanggal Bayar</th>
                            <th>Status</th>
                            <th>Dibayar</th>
                            <th>Biaya Tambahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collection as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->outlet->nama}}</td>
                            <td>{{$item->kode_invoice}}</td>
                            <td>{{$item->customer->nama}}</td>
                            <td>{{date('d-m-Y', strtotime($item->tgl))}}</td>
                            <td>{{date('d-m-Y', strtotime($item->batas_waktu))}}</td>
                            <td>{{ $item->tgl_bayar ? date('d-m-Y', strtotime($item->tgl_bayar)) : '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $item->status == 'selesai' ? 'success' : 'warning' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $item->dibayar == 'dibayar' ? 'success' : 'danger' }}">
                                    {{ ucfirst($item->dibayar) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($item->biaya_tambahan, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{url('transaksi/edit/'.$item->id)}}" class="fas fa-edit" title="Edit"></a>
                                |
                                <a href="{{url('transaksi/delete/'.$item->id)}}" class="fas fa-trash-alt" onclick="return confirm(Apa anda yakin ingin menghapus transaksi dengan kode {{$item->kode_invoice}}?)" style="color: red" title="Hapus"></a>
                                |
                                <a href="{{url('transaksi/detail/'.$item->id)}}" class="fas fa-eye" title="Detail"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

</x-layout>
