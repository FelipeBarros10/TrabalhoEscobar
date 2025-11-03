<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'hex_code',
    ];

    /**
     * Vehicles painted with this color.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}

