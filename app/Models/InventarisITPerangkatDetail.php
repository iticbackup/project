<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisITPerangkatDetail extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'inventaris_it_perangkat_detail';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'inventaris_it_perangkat_id',
        'jenis_asset',
        'kode_asset',
        'status',
    ];
    
}
