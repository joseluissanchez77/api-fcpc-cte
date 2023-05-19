<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory,SoftDeletes;


    /**
     * table
     *
     * @var string
     */
    protected $table = 'company';


    /**
     * dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'nombre',
        'ruc',
        'razon_social',
        'razon_comercial',
        'direccion',
        'emai',
        'procentaje_iva',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
