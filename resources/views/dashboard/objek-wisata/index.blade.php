@extends('.layout.main')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/trix.css')}}">
<style>
    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }
</style>

@endpush

@push('scripts')
<script src="{{asset('js/trix.js')}}"></script>
@endpush

@section('container')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Objek Wisata</h1>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-7 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Wisata</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Objek Wisata</th>
                                <th>Kategori</th>
                                <th>Fasilitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($datas) !== 0)
                            @foreach($datas as $data)
                            <tr>
                                <td>{{$data->nama_wisata}}</td>
                                <td>{{$data->kategori_wisatas->kategori_wisata}}</td>
                                <td>{!! $data->fasilitas !!}</td>
                                <td class="d-flex justify-content-evenly">
                                    <button type="button" class="border-0 badge bg-warning" data-url="{{Route('kwst.edit', $data->id)}}" id="editkwst" data-bs-toggle="modal" data-bs-target="#edit-kategori-wisata">Edit</button>
                                    <form action="{{Route('objwst.destroy', $data->id)}}" method="post" class="d-inline">

                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="border-0 badge bg-danger" onclick="return confirm('are you sure ?')"></span>Delete</button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak Ada Data Objek Wisata</td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-5 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Objek Wisata</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="{{Route('objwst.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_wisata" class="form-label">Objek Wisata</label>

                        <input type="text" name="nama_wisata" id="nama_wisata" value="{{old('nama_wisata')}}" class="form-control @error('nama_wisata') is-invalid @enderror">
                        @error('nama_wisata')
                        <div id="nama_wisata" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Gambar</label>
                        <input class="form-control" type="file" name="foto" id="foto">
                        @error('foto')
                        <div id="foto" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="kategori_wisata_id" class="form-label">Kategori Wisata</label>
                        <select class="form-select @error('kategori_wisata_id') is-invalid @enderror" id="kategori_wisata_id" name="kategori_wisata_id" aria-label="Default select example">
                            @foreach($kategoriWst as $kategori)
                            @if(old('kategori_wisata_id') == $kategori->id)
                            <option value="{{$kategori->id}}" selected>{{$kategori->kategori_wisata}}</option>
                            @else
                            <option value="{{$kategori->id}}">{{$kategori->kategori_wisata}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('kategori_wisata_id')

                        <div id="kategori_wisata_id" class="invalid-feedback">
                            {{$message}}
                        </div>

                        @enderror

                    </div>

                    <div class="mb-3">
                        <label for="fasilitas" class="form-label">fasilitas</label>
                        <input id="fasilitas" value="{{old('fasilitas')}}" type="hidden" name="fasilitas" class="@error('fasilitas') is-invalid @enderror">
                        <trix-editor input="fasilitas"></trix-editor>
                        @error('fasilitas')

                        <div class="invalid-feedback">
                            {{$message}}
                        </div>

                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input id="deskripsi" type="hidden" name="deskripsi" value="{{old('deskripsi')}}" class="@error('deskripsi') is-invalid @enderror">
                        <trix-editor input="deskripsi"></trix-editor>
                        @error('deskripsi')

                        <div class="invalid-feedback">
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

                            <input type="text" name="kategori_wisata" id="kategori_wisata_edit" value="{{old('kategori_wisata')}}" class="form-control @error('kategori_wisata') is-invalid @enderror">
                            @error('kategori_wisata')
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