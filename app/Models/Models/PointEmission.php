<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointEmission extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * table
     *
     * @var string
     */
    protected $table = 'point_emission';


    /**
     * dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'numero_punto_emision',
        'nombre',
        'establishment_id',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * company
     *
     * @return BelongsTo
     */
    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class, 'establishment_id');
    }
}
