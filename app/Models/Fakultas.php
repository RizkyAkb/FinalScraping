<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $fillable = [
        'fakultas_name', 'year_founded'
    ];

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
