<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileManagersList extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'file_managers_list';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'departemen_id',
        'sub_nama_berkas',
        'slug',
    ];
    public function departemen()
    {
        return $this->belongsTo(\App\Models\Departemen::class, 'departemen_id');
    }
    public function departemen_detail()
    {
        return $this->belongsTo(\App\Models\DepartemenDetail::class, 'departemen_id');
    }
}
