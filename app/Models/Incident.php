<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'datetime',
        'description',
        'vehicles',
        'vehicles.*',
    ];
    public function vehicles() {
        return $this->belongsToMany(Vehicle::class);
    }
}
?>
