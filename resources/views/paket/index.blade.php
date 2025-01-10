<x-layout title="Data Paket">

    <!-- Page Heading -->
    <div class="card-header border-0 mb-1">
        <a href="{{url('paket/add')}}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Paket
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table Paket Cucian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                          <th>ID Outlet</th>
                          <th>Jenis</th>
                          <th>Nama Paket</th>
                          <th>Harga</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($collection as $item)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->outlet->nama}}</td>
                            <td>{{$item->jenis}}</td>
                            <td>{{$item->nama_paket}}</td>
                            <td>{{$item->harga}}</td>
                            <td>
                                <a href="{{url('paket/edit/'.$item->id)}}" class="fas fa-edit"></a>
                                |
                                <a href="{{url('paket/delete/'.$item->id)}}" class="fas fa-trash-alt" onclick="return confirm(`Apa anda yakin ingin menghapus data {{$item->nama_paket}}?`)" style="color: red"></a>
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
