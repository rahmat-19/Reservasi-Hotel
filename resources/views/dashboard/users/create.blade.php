@extends('.layout.main')
@section('container')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-6 mb-4">

                </div>
                <div class="col-lg-6 mb-4">

                </div>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>

                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama">
                @error('nama')
                <div id="nama" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>

                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                @error('email')
                <div id="email" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>

            <hr>
            <div class="mb-3">

                <button type="submit" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">Simpan User</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection