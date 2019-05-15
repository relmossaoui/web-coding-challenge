<?php

namespace App\Http\Controllers;

use App\Services\Shop\ShopService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class ShopController extends Controller
{
    const INVALID_TOKEN     = 1;
    const UNKNOWN_REASON    = 2;

    /** @var ShopService $shopService */
    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function getShops()
    {
        $user = auth()->userOrFail();

        $preferredShops = $user->shops()->get();

        $shops = $this->shopService->getShops();

        $shops = $shops->diff($preferredShops);

        return response()->json(['status' => true,'shops' => $shops ], 200);
    }

    public function likeShop(Request $request)
    {
        $user = auth()->userOrFail();

        $shopId =  $request->get('shopId');

        if (! $user->shops()->where('id', $shopId)->first()) {
            $user->shops()->attach($request->get('shopId'));
        }

        return response()->json(['status' => true, 'message' => 'the shop is successfully added to your preferred shops list'], 200);
    }

    public function getPreferredShops()
    {
        $user = auth()->userOrFail();
        $preferredShops = $user->shops;

        return response()->json(['status' => true, 'shops' => $preferredShops], 200);
    }

    public function removePreferredShop(Request $request)
    {
        $user = auth()->userOrFail();

        if ($user->shops()->where('id', $request->get('shopId'))->first()) {
            $user->shops()->detach($request->get('shopId'));
        }

        return response()->json(['status' => true, 'message' => 'the shop is successfully removed from your preferred shops list'], 200);
    }
}