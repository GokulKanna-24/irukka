<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'alise_name', 'is_open', 'is_active', 'delete_flag', 'owner_id'];

    public function details()
    {
        return $this->hasOne(ShopDetail::class, 'shop_id');
    }

    public function owner()
    {
        return $this->hasOneThrough(User::class, ShopDetail::class, 'shop_id', 'id', 'id', 'owner_id');
    }
}
