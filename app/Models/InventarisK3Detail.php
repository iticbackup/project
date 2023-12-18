<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisK3Detail extends Model
{
    use HasFactory;
    
    public $table = 'inventaris_k3_detail';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'inventaris_k3_id',
        'jenis_barang',
        'status',
    ];
    // public function form_apart(){
    // 	return $this->hasMany('App\Models\FormApart','inventaris_k3_detail_id'); 
    // }
    public function detail_form_apar()
    {
        return $this->hasOne(\App\Models\FormApart::class, 'inventaris_k3_detail_id');
    }

    public function form_apart()
    {
        return $this->hasMany(\App\Models\FormApart::class, 'inventaris_k3_detail_id')->where('status','Y');
    }

    public function form_hydrant()
    {
        return $this->hasMany(\App\Models\FormHydrant::class, 'inventaris_k3_detail_id')->where('status','Y');
    }

    public function report_form_apar($periode_form,$periode_to)
    {
        return $this->hasMany(\App\Models\FormApart::class)->whereBetween('periode',[$periode_from,$periode_to]);
    }
}
