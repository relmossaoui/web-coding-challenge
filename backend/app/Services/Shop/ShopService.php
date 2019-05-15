<?php

namespace App\Services\Shop;

use App\Models\Shop;
use App\Models\User;

class ShopService
{
    public function getShops()
    {
        return Shop::orderBy('distance', 'desc')->get();
    }

    public function getPreferredShops(User $user)
    {
        return $user->shops;
    }

    public function getShopsNotPreferredByUser(User $user)
    {
        $preferredShops = $this->getPreferredShops($user);
        $shops = $this->getShops();

        return $shops->diff($preferredShops);
    }

    public function attachShopToUser(User $user, $shopId)
    {
        $user->shops()->attach($shopId);
    }

    public function detachShopFromUser(User $user, $shopId)
    {
        $user->shops()->detach($shopId);
    }
}