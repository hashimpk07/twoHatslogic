<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['session_id'];

    public function items()
    {
        return $this->hasMany(CartItems::class);
    }
}

