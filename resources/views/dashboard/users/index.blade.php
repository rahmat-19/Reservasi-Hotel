@extends('.layout.main')
@section('container')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
</div>


<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
        <a href="{{Route('user.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Create User</a>
    </div>
    <!-- Card Body -->
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Alamat</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($datas) !== 0)
                    @foreach($datas as $data)
                    <tr>
                        <td>{{$data->karyawans->nama_lengka}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->karyawans->no_hp}}</td>
                        <td>{{$data->karyawans->alamat}}</td>
                        <td>{{$data->karyawans->jabatan}}</td>
                        <td class="d-flex justify-content-between">
                            <a href="{{Route('user.edit', $data->id)}}" class="border-0 badge bg-warning">Edit</a>
                            <form action="{{Route('user.delete', $data->id)}}" method="post" class="d-inline">

                                @method('delete')
                                @csrf
                                <button type="submit" class="border-0 badge bg-danger" onclick="return confirm('are you sure ?')"></span>Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada Data User</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</div>




@endsection