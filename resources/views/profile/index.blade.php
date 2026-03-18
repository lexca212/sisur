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
                </div>
            </form>
        </div>
    </div>
</div>

@endsection