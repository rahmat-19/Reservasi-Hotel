@extends('.layout.main')
@push('styles')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


@endpush

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script>
    $(document).on('click', '#editkwst', function() {
        const url = $(this).data('url');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                /* TODO */
                $("#kategori_wisata_edit").val(data.kategori_berita)
                var url = '{{ route("kbrt.update", ":id") }}';
                url = url.replace(':id', data.id);
                $('#kwst-edit').attr('action', url);



            }
        })
    })
</script>
@endpush
@section('container')



<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kategori Berita</h1>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Berita</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Wisata</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($datas) !== 0)
                            @foreach($datas as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->kategori_berita}}</td>
                                <td>{{(new DateTime($data->created_at))->format('d M Y')}}</td>
                                <td class="d-flex justify-content-evenly">
                                    <button type="button" class="border-0 badge bg-warning" data-url="{{Route('kbrt.edit', $data->id)}}" id="editkwst" data-bs-toggle="modal" data-bs-target="#edit-kategori-wisata">Edit</button>
                                    <form action="{{Route('kbrt.delete', $data->id)}}" method="post" class="d-inline">

                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="border-0 badge bg-danger" onclick="return confirm('are you sure ?')"></span>Delete</button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak Ada Data Kategori Berita</td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Beriat</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="{{Route('kbrt.create')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="kategori_berita" class="form-label">Kategori Berita</label>

                        <input type="text" name="kategori_berita" id="kategori_berita" value="{{old('kategori_berita')}}" class="form-control @error('kategori_berita') is-invalid @enderror">
                        @error('kategori_berita')
                        <div id="kategori_berita" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <hr>

                    <button type="submit" class="btn btn-primary w-full">Simpan</button>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-kategori-wisata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="kwst-edit">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="kategori_wisata_edit" class="form-label">Kategori Wisata</label>

                            <input type="text" name="kategori_berita" id="kategori_wisata_edit" value="{{old('kategori_berita')}}" class="form-control @error('kategori_berita') is-invalid @enderror">
                            @error('kategori_berita')
                            <div id="kategori_wisata_edit" class="invalid-feedback mb-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>


@endsection