<?php

namespace App\Services\Shop;

use App\Models\Shop;

class ShopService
{
    public function getShops()
    {
        return Shop::orderBy('distance', 'desc')->get();
    }
}