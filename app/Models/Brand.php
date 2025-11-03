<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'country',
    ];

    /**
     * Brand has many vehicle models.
     */
    public function models()
    {
        return $this->hasMany(VehicleModel::class);
    }

    /**
     * Brand has many vehicles through its models.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}

