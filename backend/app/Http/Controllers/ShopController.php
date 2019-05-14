<?php

namespace App\Http\Controllers;

use App\Services\Shop\ShopService;
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
        try {
            $user = auth()->userOrFail();

            $shops = $this->shopService->getShops();

            return response()->json([
                'shops' => $shops,
            ], 200);

        } catch (UserNotDefinedException $e) {
            return response()->json(['status' => false, 'message' => "User not found", 'type' => self::INVALID_TOKEN], 402);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => "Something wrong happen", 'type' => self::UNKNOWN_REASON], 402);
        }

    }
}