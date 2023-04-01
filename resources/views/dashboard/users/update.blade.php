@extends('.layout.main')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


@endpush



@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
    </div>
    <div class="card-body">
        <form action="{{Route('user.update', $data->id)}}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama</label>

                        <input type="text" value="{{old('nama_lengkap', $data->karyawans->nama_lengkap)}}" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Nama">
                        @error('nama_lengkap')
                        <div id="nama_lengkap" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>

                        <input type="text" name="email" id="email" value="{{old('email', $data->email)}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        @error('email')
                        <div id="email" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No Handphone</label>

                        <input type="text" name="no_hp" id="no_hp" value="{{old('no_hp', $data->karyawans->no_hp)}}" class="form-control @error('no_hp') is-invalid @enderror" placeholder="No Handphone">
                        @error('no_hp')
                        <div id="no_hp" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>

                        <select class="form-select" id="level" name="level" aria-label="Default select example">
                            @foreach($enumLevel as $level)
                            @if(old('level', $data->level) == $level['key'])
                            <option value="{{$level['key']}}" selected>{{$level['value']}}</option>
                            @else
                            <option value="{{$level['key']}}">{{$level['value']}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('level')
                        <div id="level" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="col-lg-6 mb-4">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>

                        <input type="text" name="alamat" id="alamat" value="{{old('alamat', $data->karyawans->alamat)}}" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">
                        @error('alamat')
                        <div id="alamat" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>

                        <select class="form-select" id="jabatan" name="jabatan" aria-label="Default select example">
                            @foreach($enumJabatan as $jabatan)
                            @if(old('jabatan', $data->karyawans->jabatan) == $jabatan['key'])
                            <option value="{{$jabatan['key']}}" selected>{{$jabatan['value']}}</option>
                            @else
                            <option value="{{$jabatan['key']}}">{{$jabatan['value']}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('jabatan')
                        <div id="jabatan" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">password</label>

                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
                        @error('password')
                        <div id="password" class="invalid-feedback mb-3">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>


            <hr>
            <div class="mb-3">

                <a href="{{Route('user.index')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</div>

@endsection