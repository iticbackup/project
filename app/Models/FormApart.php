<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormApart extends Model
{
    use HasFactory;
    public $table = 'form_apart';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'inventaris_k3_detail_id',
        'kode_tabung',
        'jenis',
        'warna',
        'berat',
        'expired',
        'tempat',
        'periode',
        'status',
    ];
    public function detail_inventaris_k3()
    {
        return $this->belongsTo(\App\Models\InventarisK3Detail::class, 'inventaris_k3_detail_id');
    }

    public function detail_form_apart_detail()
    {
        return $this->hasOne(\App\Models\FormApartDetail::class, 'form_apart_id');
        // return $this->belongsTo(\App\Models\FormApartDetail::class, 'id','form_apart_id');
    }
}
