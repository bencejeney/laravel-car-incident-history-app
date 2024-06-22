<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['license_plate', 'brand', 'type', 'manufacture_year', 'image'];

    public function incidents() {
        return $this->belongsToMany(Incident::class);
    }
}
?>
