@extends('layouts.admin')

@section('title', 'Create Instansi')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Instansi</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('instansi.update', $instansi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="code">Kode</label>
                    <input type="text" name="code" class="form-control" id="code"
                        placeholder="Kode Instansi" value="{{ $instansi->code }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $instansi->nama }}" id="nama"
                        placeholder="Nama instansi baru">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ $instansi->email }}" id="email"
                  placeholder="Email pengguna">
                </div>
                <div class="form-group">
                  <label for="tlpn">No. Telepon</label>
                  <input type="text" name="tlpn" class="form-control" value="{{ $instansi->tlpn }}" id="tlpn"
                  placeholder="No. telepon perusahaan ">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" cols="10" rows="5">{{ $instansi->alamat }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

    <!-- general form elements -->
@endsection

@push('js')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`
            })
        </script>
    @endif
@endpush
