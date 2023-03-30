@extends('.layout.main')
@section('container')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
</div>


<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
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
                        <th></th>
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
                        <td></td>
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