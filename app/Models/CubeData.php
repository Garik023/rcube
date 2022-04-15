<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property array matrix
 */
class CubeData extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'matrix',
        'direction',
        'degree',
        'side'
    ];

    /**
     * @param $value
     * @return mixed
     */
    public function getMatrixAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * @param $value
     * @return void
     */
    public function setMatrixAttribute($value)
    {
        $this->attributes['matrix'] = json_encode($value);
    }
}
