@extends('layout.main-login')


@section('container')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" action="{{Route('register.authentication')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="email" value="{{old('email')}}" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email *">
                                @error('email')
                                <div id="email" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="text" value="{{old('no_hp')}}" class="form-control form-control-user @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" placeholder="No Handphone">
                                @error('no_hp')
                                <div id="no_hp" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{old('nama')}}" class="form-control form-control-user @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama *">
                            @error('nama')
                            <div id="nama" class="invalid-feedback mb-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password *">
                            @error('password')
                            <div id="password" class="invalid-feedback mb-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" value="{{old('alamat')}}" class="form-control form-control-user @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat *">
                                @error('alamat')
                                <div id="alamat" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control @error('foto') is-invalid @enderror" name="foto" type="file" id="foto">
                                @error('foto')
                                <div id="foto" class="invalid-feedback mb-3">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                    <hr>

                    <div class="text-center">
                        <a class="small" href="{{Route('login')}}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection