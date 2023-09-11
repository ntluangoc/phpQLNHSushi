<?php

namespace App\Http\Controllers;

use App\Http\Services\RestaurantService;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    //
    protected $restaurantService;
    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    public function getRestaurant()
    {
        return view('manager.restaurant',[
            'title'=>'Restaurant',
            'restaurant' => $this->restaurantService->getInfoRestaurant()
        ]);
    }

    public function getRevenueByMonth()
    {
        $result = $this->restaurantService->getRevenueByMonth();
        return $result;
    }

    public function getRevenueByDay()
    {
        $result = $this->restaurantService->getRevenueByDay();
        return $result;
    }

    public function updateTimeRestaurant(Request $request)
    {
        $result = $this->restaurantService->updateTimeRestaurant($request);
        return redirect()->back();
    }

    public function getTimeOpenClose()
    {
        $restaurant = Restaurant::find(1);
        $timeOpen = $restaurant->timeOpen;
        $timeClose = $restaurant->timeClose;

        return response()->json([
            'timeOpen' => $timeOpen,
            'timeClose' => $timeClose
        ]);
    }
}
