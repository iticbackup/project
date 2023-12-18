<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileManagersDetails extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'file_managers_detail';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'file_managers_list_id',
        // 'sub_nama_berkas',
        // 'slug',
        'files',
    ];

    public function file_manager_list()
    {
        return $this->belongsTo(\App\Models\FileManagersList::class, 'file_managers_list_id');
    }

}
