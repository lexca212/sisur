@extends('layouts.admin')

@section('title', 'Update User')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data User</h3>
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
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" id="name"
                        placeholder="Nama pengguna baru" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email pengguna"
                        value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="role">Hak Akses</label>
                    <select class="form-control" name="role">
                        <option value="-" selected disabled>-- Pilih hak akses pengguna --</option>
                        @foreach ($role_select as $role)
                            <option value="{{ $role }}" @if ($user->role == $role) selected @endif>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
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
