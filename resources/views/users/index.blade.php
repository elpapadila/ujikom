<x-layout title="Data user">

    <!-- Page Heading -->
    <div class="card-header border-0 mb-1">
        <a href="{{url('user/add')}}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Peran</th>
                          <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collection as $item)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->password}}</td>
                            <td>{{$item->role}}</td>
                            <td>
                                <a href="{{url('user/edit/'.$item->id)}}" class="fas fa-edit"></a>
                                |
                                <a href="{{url('user/delete/'.$item->id)}}" class="fas fa-trash-alt" onclick="return confirm(`Apa anda yakin ingin menghapus data {{$item->name}}?`)" style="color: red"></a>
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

