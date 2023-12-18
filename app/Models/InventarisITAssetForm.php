<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisITAssetForm extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'inventaris_it_asset_detail_form';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'inventaris_it_perangkat_detail_id',
        'lokasi',
        'jenis_merk',
        'jenis_type',
        'spesifikasi',
    ];

    public function it_asset_detail()
    {
        return $this->belongsTo(\App\Models\InventarisITAssetDetail::class, 'inventaris_it_perangkat_detail_id');
    }
    public function perangkat_detail()
    {
        return $this->belongsTo(\App\Models\InventarisITPerangkatDetail::class, 'inventaris_it_perangkat_detail_id');
    }
}
