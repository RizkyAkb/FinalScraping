<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id','title', 'journal_name', 'publication_date', 'doi', 'citations','source'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
