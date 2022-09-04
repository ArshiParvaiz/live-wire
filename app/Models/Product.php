<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'price',
    ];

    public static function search($query)
    {
        return empty($query) ? Product::all()
            : Product::where(function($q) use ($query) {
                    $q
                        ->where('name', 'LIKE', '%'. $query . '%')
                        ->orWhere('description', 'LIKE', '%' . $query . '%');
                });
    }
}
