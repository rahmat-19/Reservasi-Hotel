@extends('.layout.main')
@section('container')



<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kontent Berita</h1>
</div>


<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Kontent Berita</h6>
        <a href="{{Route('berita.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Buat Berita</a>
    </div>
    <!-- Card Body -->
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal Post</th>
                        <th>Konten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($datas) !== 0)
                    @foreach($datas as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->judul}}</td>
                        <td>{{$data->kategori_beritas->kategori_berita}}</td>
                        <td>{{(new DateTime($data->tgl_post))->format('d M Y')}}</td>
                        <td>
                            {!! Illuminate\Support\Str::limit($data->berita, 150) !!}
                        </td>
                        <td class="d-flex justify-content-around">
                            <a href="{{Route('berita.edit', $data->id)}}" class="border-0 badge bg-warning">Edit</a>
                            <form action="{{Route('berita.destroy', $data->id)}}" method="post" class="d-inline">

                                @method('delete')
                                @csrf
                                <button type="submit" class="border-0 badge bg-danger" onclick="return confirm('are you sure ?')"></span>Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada Konten Berita</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</div>


@endsection