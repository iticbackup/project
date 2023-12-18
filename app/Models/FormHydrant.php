<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormHydrant extends Model
{
    use HasFactory;
    public $table = 'form_hydrant';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'inventaris_k3_detail_id',
        'kode_hydrant',
        'lokasi',
        'periode',
        'status'
    ];

}
