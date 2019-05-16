<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Shop\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /** @var ShopService $shopService */
    protected $shopService;

    /** @var User $user */
    protected $user;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;

        $this->user = auth()->userOrFail();
    }

    /**
     * Get shops not preferred by authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getShopsNotPreferredByUser()
    {
        return response()->json([
            'status' => true,
            'shops' => $this->shopService->getShopsNotPreferredByUser($this->user)
        ], 200);
    }

    /**
     * Add a shop to preferred shops of the authenticated user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeShop(Request $request)
    {
        $shopId =  $request->get('shopId');

        $this->shopService->attachShopToUser($this->user, $shopId);

        return response()->json([
            'status' => true,
            'message' => 'the shop is successfully added to your preferred shops list'
        ], 200);
    }

    /**
     * Get preferred shops of the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPreferredShops()
    {
        return response()->json([
            'status' => true,
            'shops' => $this->shopService->getPreferredShops($this->user)
        ], 200);
    }

    /**
     * remove a shop from preferred shops of the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removePreferredShop(Request $request)
    {
        $shopId = $request->get('shopId');

        $this->shopService->detachShopFromUser($this->user, $shopId);

        return response()->json([
            'status' => true,
            'message' => 'the shop is successfully removed from your preferred shops list'
        ], 200);
    }
}