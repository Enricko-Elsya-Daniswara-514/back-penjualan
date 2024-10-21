<?php

namespace App\Models\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poduk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $guarded = ['id'];
}
