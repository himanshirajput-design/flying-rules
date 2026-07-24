<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = ['airline_id', 'type', 'content'];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}
