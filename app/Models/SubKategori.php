<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "sub_kategori";

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }
}
