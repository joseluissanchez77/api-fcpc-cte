<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * table
     *
     * @var string
     */
    protected $table = 'product';


    /**
     * dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'codigo',
        'stock',
        'precio',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
