<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "dokumen";

    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class);
    }
}