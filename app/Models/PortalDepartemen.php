<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalDepartemen extends Model
{
    use HasFactory;
    public $table = 'portal_departemen';
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'portal_id',
        'departemen_id',
        'color',
    ];

    public function portal()
    {
        return $this->belongsTo(\App\Models\Portal::class, 'portal_id');
    }
    public function departemen()
    {
        return $this->belongsTo(\App\Models\Departemen::class, 'departemen_id');
    }
}
