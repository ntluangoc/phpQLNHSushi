<?php

namespace App\Http\Services;

use App\Models\Restaurant;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class RestaurantService
{
    public function getInfoRestaurant()
    {
        $restaurant = Restaurant::find(1);
        return $restaurant;
    }
    public function getRevenueByMonth()
    {
        $currentDate = now();

        // Tạo một bảng tạm chứa các tháng từ tháng hiện tại đến 4 tháng trước đó
        $tempTable = DB::table(DB::raw("(SELECT DATE_FORMAT(DATE_SUB('$currentDate', INTERVAL n MONTH), '%b %Y') AS month_year
                FROM (SELECT 0 AS n
                      UNION ALL SELECT 1
                      UNION ALL SELECT 2
                      UNION ALL SELECT 3
                      UNION ALL SELECT 4) months) AS m"))
            ->leftJoin('Bill AS b', 'm.month_year', '=', DB::raw("DATE_FORMAT(b.dateBill, '%b %Y')"))
            ->selectRaw('m.month_year AS Month, IFNULL(FORMAT(SUM(b.sumPrice), 2), 0) AS TotalSumPrice') // Định dạng số thập phân
            ->groupBy('m.month_year')
            ->orderByRaw('DATE_FORMAT(m.month_year, "%Y-%m") DESC')
            ->get();

        return response()->json($tempTable);
    }
    public function getRevenueByDay()
    {
        $currentDate = now();

        // Tạo một bảng tạm chứa các ngày từ ngày hiện tại đến 6 ngày trước đó
        $tempTable = DB::table(DB::raw("(SELECT DATE_FORMAT(DATE_SUB('$currentDate', INTERVAL n DAY), '%Y-%m-%d') AS date
                FROM (SELECT 0 AS n
                      UNION ALL SELECT 1
                      UNION ALL SELECT 2
                      UNION ALL SELECT 3
                      UNION ALL SELECT 4
                      UNION ALL SELECT 5
                      UNION ALL SELECT 6) days) AS d"))
            ->leftJoin('Bill AS b', 'd.date', '=', DB::raw("DATE_FORMAT(b.dateBill, '%Y-%m-%d')"))
            ->selectRaw('d.date AS Date, IFNULL(SUM(b.sumPrice), 0) AS TotalSumPrice')
            ->groupBy('d.date')
            ->orderByRaw('d.date DESC') // Sắp xếp theo ngày giảm dần
            ->get();

        return response()->json($tempTable);
    }

    public function updateTimeRestaurant($request)
    {
        try {
            DB::beginTransaction();
            $restaurant = Restaurant::find(1);
            $restaurant->timeOpen = Carbon::parse($request->input('timeOpen'))->format('H:i:s');
            $restaurant->timeClose = Carbon::parse($request->input('timeClose'))->format('H:i:s');
            $restaurant->save();
            DB::commit();
            Session()->flash('success', 'Update time restaurant successfully');
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }
}
