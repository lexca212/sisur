<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    //

    protected $table = 'disposisi';
    protected $guarded = ['id'];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    public function dari()
    {
        return $this->belongsTo(User::class, 'dari_user_id');
    }

    public function ke()
    {
        return $this->belongsTo(User::class, 'ke_user_id');
    }
}
