<x-layout title="Data outlet">

    <!-- Page Heading -->
    <div class="card-header border-0 mb-1">
        <a href="{{url('outlet/add')}}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Outlet
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table outlet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                          <th>Nama outlet</th>
                          <th>Alamat</th>
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
                            <td>{{$item->tlp}}</td>
                            <td>
                                <a href="{{url('outlet/edit/'.$item->id)}}" class="fas fa-edit"></a>
                                |
                                <a href="{{url('outlet/delete/'.$item->id)}}" class="fas fa-trash-alt" onclick="return confirm(`Apa anda yakin ingin menghapus data {{$item->nama}}?`)" style="color: red"></a>
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
