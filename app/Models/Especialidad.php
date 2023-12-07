<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;
    protected $table = "especialidad";
    protected $primaryKey = "id_especialidad";
    protected $fillable = [
        "cargo", "estado"
    ];
}
