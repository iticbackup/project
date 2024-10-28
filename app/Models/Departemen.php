<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departemen extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'departemen';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'nama_departemen',
    ];

    public function departemen_detail()
    {
        return $this->hasMany(\App\Models\DepartemenDetail::class, 'departemen_id','id')
                    ->whereHas('user', function($query){
                        $query->where('is_active','!=','0');
                    });
    }
}
