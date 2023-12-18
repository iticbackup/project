<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratOffice extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'surat_office';
    // protected $primaryKey = 'id';
    // public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'nomor_surat',
        'tanggal',
        'keterangan',
        'pengguna',
        'status',
    ];

}
