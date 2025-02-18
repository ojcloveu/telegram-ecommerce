<?php

namespace App\Http\Controllers\Api;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function applyDiscount(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        
        $discount = Discount::where('code', $request->code)
                            ->where('expires_at', '>', now())
                            ->first();

        if (!$discount) {
            return response()->json(['error' => 'Invalid or expired discount code'], 400);
        }

        return response()->json(['message' => 'Discount applied', 'discount' => $discount->percentage]);
    }
}
