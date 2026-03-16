@extends('layouts.admin')

@section('title', 'Edit Surat')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Surat Masuk</h3>
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
        <form action="{{ route('updatesurat', $datasurat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control" id="nomor_surat"
                        placeholder="Masukan nomor surat" value="{{ $datasurat->nomor_surat }}">
                </div>
                <div class="form-group">
                    <label for="tangal_surat">Tanggal Surat </label>
                    <input type="date" name="tangal_surat" class="form-control" id="tangal_surat"
                        placeholder="Tanggal Surat" value="{{ \Carbon\Carbon::parse($datasurat->tangal_surat)->format('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label for="pengirim">Pengirim </label>
                    <input type="text" name="pengirim" class="form-control" id="pengirim"
                        placeholder="Pengirim" value="{{ $datasurat->pengirim }}">
                </div>
                <div class="form-group">
                    <label for="perihal">Perihal </label>
                    <input type="Text" name="perihal" class="form-control" id="perihal"
                        placeholder="Perihal" value="{{ $datasurat->perihal }}">
                </div>
                <div class="form-group">
                    <label for="tujuan">Tujuan </label>
                    <input type="Text" name="tujuan" class="form-control" id="tujuan"
                        placeholder="Perihal" value="{{ $datasurat->tujuan }}">
                </div>
                <div class="form-group">
                    <label for="file_surat">File input</label>
                    <div class="form-group">
                      <a href="{{ asset('storage/'.$datasurat->file_surat) }}" target="_blank">
                                Lihat File
                      </a>
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="file_surat" class="custom-file-input" id="file_surat">
                            <label class="custom-file-label" for="file_surat">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
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
