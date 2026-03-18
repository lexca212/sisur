@extends('layouts.admin')

@section('title', 'Profile User')

@section('content')
<div class="row justify-content-center pt-4">
    <div class="col-md-8">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('success') }}
            </div>
        @endif

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cogs mr-1"></i>
                    Konfigurasi Profile
                </h3>
            </div>
            
            <form action="{{ route('profile.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $profile->id ?? '' }}">

                <div class="card-body">
                    <div class="form-group">
                        <label for="chat_id">Chat ID (Telegram)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                            </div>
                            <input type="text" 
                                   name="chat_id" 
                                   class="form-control @error('chat_id') is-invalid @enderror" 
                                   id="chat_id" 
                                   placeholder="Masukkan Chat ID..." 
                                   value="{{ old('chat_id', $profile->chat_id ?? '') }}">
                            
                            @error('chat_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="text-muted italic">*Pastikan ID sesuai dengan ID telegram anda.</small>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                    
                    @if($profile->chat_id)
                        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-delete">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@if($profile->chat_id)
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Konfirmasi Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus Chat ID <strong>{{ $profile->chat_id }}</strong>?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <form action="{{ route('profile.destroy', $profile->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection