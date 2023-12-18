<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormApartDetail extends Model
{
    use HasFactory;
    public $table = 'form_apart_detail';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'form_apart_id',
        'bulan',
        'tanggal',
        'pressure',
        'nozzel',
        'segel',
        'tuas',
        'ttd',
        'keterangan',
        'status',
        'images',
        'approval',
    ];

    public function form_apar()
    {
        return $this->belongsTo(\App\Models\FormApart::class, 'form_apart_id');
    }

}
