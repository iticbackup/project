<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratOfficeBerkas extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'surat_office_berkas';
    // protected $primaryKey = 'id';
    // public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'surat_office_id',
        'departemen_id',
        'files',
        'remaks',
        'status',
    ];

}
