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
<script>
    function previewImage() {
        const image = document.querySelector("#foto");
        const priview = document.querySelector('.img-preview')


        priview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            priview.src = oFREvent.target.result;
        }

    }
</script>
@endpush

@section('container')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Objek Wisata</h1>
</div>

<div class="card shadow mb-4 p-4">
    <form action="{{Route('objwst.update', $data->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="nama_wisata" class="form-label">Objek Wisata</label>

                    <input type="text" name="nama_wisata" id="nama_wisata" value="{{old('nama_wisata', $data->nama_wisata)}}" class="form-control @error('nama_wisata') is-invalid @enderror">
                    @error('nama_wisata')
                    <div id="nama_wisata" class="invalid-feedback mb-3">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Gambar</label>
                    @if($data->foto)
                    <img src="{{ asset('storage/' . $data->foto) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input class="form-control" type="file" name="foto" id="foto" onchange="previewImage()">
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
                        @if(old('kategori_wisata_id', $data->kategori_wisata_id) == $kategori->id)
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
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="fasilitas" class="form-label">fasilitas</label>
                    <input id="fasilitas" value="{{old('fasilitas', $data->fasilitas)}}" type="hidden" name="fasilitas" class="@error('fasilitas') is-invalid @enderror">
                    <trix-editor input="fasilitas"></trix-editor>
                    @error('fasilitas')

                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input id="deskripsi" type="hidden" name="deskripsi" value="{{old('deskripsi', $data->deskripsi)}}" class="@error('deskripsi') is-invalid @enderror">
                    <trix-editor input="deskripsi"></trix-editor>
                    @error('deskripsi')

                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror
                </div>
            </div>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary w-full">Update</button>
        <a href="{{Route('objwst.index')}}" class="btn btn-secondary">Kembali</a>


    </form>
</div>


@endsection