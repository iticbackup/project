<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Portal extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'portal';
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'id',
        'title',
        'link',
        'images',
    ];

}
