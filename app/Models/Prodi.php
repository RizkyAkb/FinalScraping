<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = [
        'prodi_name','fakultas_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
