<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormHydrantDetail extends Model
{
    use HasFactory;
    public $table = 'form_hydrant_detail';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'form_hydrant_id',
        'bulan',
        'tanggal',
        'selang',
        'kran',
        'nozzel',
        'checker',
        'keterangan',
        'status',
        'images',
        'approval',
    ];

}
