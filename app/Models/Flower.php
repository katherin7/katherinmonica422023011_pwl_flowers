<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flower extends Model
{
    // use HasFactory;
    use Softdeletes;
    protected $table = 'Flowers';
    protected $fillable = [
        'id',
        'jenis_bunga',
        'price',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
    protected $dates = ['deleted_at'];  
    public function data_adder(){   
        return $this ->belongsTo(User::class, 'created_by','id');
    }
}
