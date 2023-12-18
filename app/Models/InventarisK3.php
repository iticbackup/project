<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisK3 extends Model
{
    use HasFactory;

    public $table = 'inventaris_k3';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'kode_barcode',
        'lokasi',
        'departemen_id',
    ];

    public function departemen()
    {
        return $this->belongsTo(\App\Models\Departemen::class, 'departemen_id');
    }
    
    public function detail_inventaris_k3_detail()
    {
        return $this->hasOne(\App\Models\InventarisK3Detail::class, 'inventaris_k3_id');
    }

    public function inventaris_k3_detail()
    {
        return $this->hasMany(\App\Models\InventarisK3Detail::class, 'inventaris_k3_id');
    }

}
