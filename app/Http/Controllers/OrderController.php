<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function getUserOrdersHistory(Request $request, $userId): JsonResponse
    {
        try {

            $perPage = $request->query('per_page',10);

            if (!is_numeric($perPage) || $perPage <= 0) {
                $perPage = 10;
            }

            $orders = Order::with(['items.product'])
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return response()->json([
                'status' => true,
                'message' => 'Order history fetched successfully',
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'total_orders' => $orders->total(),
                'orders' => $orders->items()
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}