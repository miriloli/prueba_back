<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function setOrder(Request $request)
    {
        try {
            $user_id = $request->input("user_id");
            $pickup_date = $request->input("pickup_date");
            $pickup_time = $request->input("pickup_time");
            $payment_method = $request->input("payment_method");

            $order = new Order();
            $order->user_id = $user_id;
            $this->setPickupDate($order, $pickup_date);
            $this->setPickupTime($order, $pickup_time);
            $order->payment_method = $payment_method;

            $insertOK = $order->save();

            if ($insertOK) {
                return response()->json(['order' => $order], 201);
            } else {
                return response()->json(['error' => 'Error, Processing order '], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error, Processing order: ' . $e->getMessage()], 500);
        }
    }

    public function historyGet()
    {
        try {
            $orders = Order::where('user_id', '1')->paginate(10);
            if ($orders !== null) {
                return response()->json(['orders' => $orders], 200);
            } else {
                return response()->json(['error' => 'Error, getting history '], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error, getting history: ' . $e->getMessage()], 500);
        }
    }
    private function setPickupDate($order, $pickup_date)
    {
        $date = strtotime($pickup_date);
        $format_date = date("Y-m-d", $date);
        $order->pickup_date = $format_date;
    }
    private function setPickupTime($order, $pickup_time)
    {
        $time = strtotime($pickup_time);
        $format_time = date("H:i:s", $time);
        $order->pickup_time = $format_time;
    }
}
