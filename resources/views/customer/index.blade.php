<x-layout title="Data Customer">

    <!-- Page Heading -->
    <div class="card-header border-0 mb-1">
        <a href="{{url('customer/add')}}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Customer
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table Customer</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                          <th>Nama customer</th>
                          <th>Alamat</th>
                          <th>Jenis Kelamin</th>
                          <th>No Telp</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($collection as $item)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->jenis_kelamin}}</td>
                            <td>{{$item->telp}}</td>

                            <td>
                                <a href="{{url('customer/edit/'.$item->id)}}" class="fas fa-edit"></a>
                                |
                                <a href="{{url('customer/delete/'.$item->id)}}" class="fas fa-trash-alt" onclick="return confirm(`Apa anda yakin ingin menghapus data {{$item->nama}}?`)" style="color: red"></a>
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
