<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id', 'adress_line1', 'adress_line2', 'owner_id', 'start_time', 'end_time',
        'banner_img', 'logo_img', 'shop_img', 'is_active', 'delete_flag'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    // Define relationship: A shop belongs to an owner (User)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
