<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // exact name jo DB me hai
    protected $fillable = ['product_name', 'description', 'product_price', 'file_path'];
}
