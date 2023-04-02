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
    <h1 class="h3 mb-0 text-gray-800">Konten Berita</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Update Kontent Berita</h6>
    </div>

    <div class="card-body">
        <form action="{{Route('berita.update', $data->id)}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" value="{{old('judul', $data->judul)}}" class="form-control @error('judul') is-invalid @enderror">
                @error('judul')
                <div id="judul" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kategori_berita_id" class="form-label">Kategori Wisata</label>
                <select class="form-select @error('kategori_berita_id') is-invalid @enderror" id="kategori_berita_id" name="kategori_berita_id" aria-label="Default select example">
                    @foreach($kategoriBrt as $kategori)
                    @if(old('kategori_berita_id', $data->kategori_berita_id) == $kategori->id)
                    <option value="{{$kategori->id}}" selected>{{$kategori->kategori_berita}}</option>
                    @else
                    <option value="{{$kategori->id}}">{{$kategori->kategori_berita}}</option>
                    @endif
                    @endforeach
                </select>
                @error('kategori_berita_id')

                <div id="kategori_berita_id" class="invalid-feedback">
                    {{$message}}
                </div>

                @enderror

            </div>
            <div class="mb-3">
                <label for="tgl_post" class="form-label">Tanggal</label>
                <input type="date" name="tgl_post" id="tgl_post" value="{{old('tgl_post', $data->tgl_post)}}" class="form-control @error('tgl_post') is-invalid @enderror">
                @error('tgl_post')
                <div id="tgl_post" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Gambar</label>
                @if($data->foto)
                <img src="{{ asset('storage/' . $data->foto) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" style="width: 15rem">
                @else
                <img class="img-preview img-fluid mb-3 col-sm-5" style="width: 15rem">
                @endif
                <input class="form-control" type="file" name="foto" id="foto" onchange="previewImage()">
                @error('foto')
                <div id="foto" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fasilitas" class="form-label">Berita</label>
                <input id="fasilitas" value="{{old('berita', $data->berita)}}" type="hidden" name="berita" class="@error('berita') is-invalid @enderror">
                <trix-editor input="fasilitas"></trix-editor>
                @error('berita')

                <div class="invalid-feedback">
                    {{$message}}
                </div>

                @enderror
            </div>
            <hr>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-full me-2">Simpan</button>

                <a href="{{Route('berita.index')}}" class="btn btn-secondary">Kembali</a>

            </div>

        </form>
    </div>

</div>
@endsection