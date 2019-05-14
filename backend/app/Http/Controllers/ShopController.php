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
        try {
            $user = auth()->userOrFail();

            $preferredShops = $user->shops()->get();

            $shops = $this->shopService->getShops();

            $shops = $shops->diff($preferredShops);

            return response()->json([
                'shops' => $shops,
            ], 200);

        } catch (UserNotDefinedException $e) {
            return response()->json(['status' => false, 'message' => "User not found", 'type' => self::INVALID_TOKEN], 402);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => "Something wrong happen", 'type' => self::UNKNOWN_REASON], 402);
        }

    }

    public function likeShop(Request $request)
    {
        try {
            $user = auth()->userOrFail();

            $shopId =  $request->get('shopId');

            if (! $user->shops()->where('id', $shopId)->first()) {
                $user->shops()->attach($request->get('shopId'));
            }

            return response()->json(['message' => 'the shop is successfully added to your preferred shops list'], 200);

        } catch (UserNotDefinedException $e) {
            return response()->json(['status' => false, 'message' => "User not found", 'type' => self::INVALID_TOKEN], 402);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => "Something wrong happen", 'type' => self::UNKNOWN_REASON], 402);
        }
    }

    public function getPreferredShops()
    {
        try {
            $user = auth()->userOrFail();
            $preferredShops = $user->shops;

            return response()->json(['shops' => $preferredShops], 200);

        } catch (UserNotDefinedException $e) {
            return response()->json(['status' => false, 'message' => "User not found", 'type' => self::INVALID_TOKEN], 402);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => "Something wrong happen", 'type' => self::UNKNOWN_REASON], 402);
        }
    }
}