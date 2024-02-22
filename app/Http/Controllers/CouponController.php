<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    public function generateRandomCouponCode($length)
    {
        // Các ký tự có thể sử dụng để tạo mã giảm giá
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        // Số lượng ký tự trong chuỗi
        $charactersLength = strlen($characters);

        // Biến để lưu mã giảm giá
        $couponCode = '';

        // Tạo mã giảm giá ngẫu nhiên
        for ($i = 0; $i < $length; $i++) {
            $couponCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $couponCode;
    }

    public function addCoupon(Request $request)
    {
        $coupon = Coupon::create([
            'code' => $this->generateRandomCouponCode(8),
            'type' => $request->type,
            'des' => $request->des,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'sucessfully',
            'coupon' => $coupon,
        ]);
    }

    public function getAllCoupon()
    {
        $coupons = Coupon::all();
        return response()->json([
            'status' => 200,
            'message' => 'sucessfully',
            'coupon' => $coupons,
        ]);
    }

    public function deletecoupon($coupon_id)
    {
        $coupon = Coupon::where('id', $coupon_id)->first();
        $coupon->delete();
        return response()->json([
            'status' => 200,
            'message' => 'delete sucessfully',
        ]);
    }

    //User
    public function exchange(Request $request)
    {
        $user = User::where('id', 1)->first();
        $mypoint = $user->point;
        $coupon = Coupon::where('id', $request->get('coupon_id'))->first();
        $point = $coupon->point;
        if ($mypoint < $point) {
            return response()->json([
                'status' => 500,
                'message' => 'khong du diem',
            ]);
        } else {
            $mypoint -= $point;
            $user->update(['point' => $mypoint]);
            $usercoupon = UserCoupon::create(['user_id' => 1, 'coupon_id' => $request->get('coupon_id'),]);
            // $coupon->delete();
            return response()->json([
                'status' => 200,
                'message' => 'successfully',
            ]);
        }
    }
    public function getmycoupon()
    {
        $coupons = UserCoupon::where('user_id', 1)->get();
        foreach ($coupons as $coupon) {
            $item = Coupon::where('id', $coupon->coupon_id)->first();
            $coupon->code = $item->code;
            $coupon->des = $item->des;
            $coupon->type = $item->type;
            $coupon->status = $item->status;
            $coupon->condition = $item->condition;
            $coupon->start_date = $item->start_date;
            $coupon->end_date = $item->end_date;
        }
        return response()->json([
            'status' => 200,
            'message' => 'successfully',
            'coupons' => $coupons,
        ]);
    }

    public function apply(Request $request)
    {
        $price = $request->get('price');
        $coupon = Coupon::where("code", $request->get('id'))->first();
        if ($coupon->status != '2') {
            
            if ($coupon->condition) {
                if ($price >= $coupon->condition) {
                    switch ($coupon->type) {
                        case '1': // giam theo %
                            $price = $price * (1 - $coupon->value / 100);
                            break;
                        case '2': // giam theo tien
                            $price = $price - $coupon->value;
                            break;
                        default:
                            break;
                    }
                    $coupon->update(['status' => '2']);
                    return response()->json([
                        'message' => 'successfully',
                        'price' => $price,
                    ], 200);
                }
                else {
                    return response()->json([
                        'message' => 'Không đủ điều kiện',
                    ], 500);
                }
            }
            else {
                switch ($coupon->type) {
                    case '1': // giam theo %
                        $price = $price * (1 - $coupon->value / 100);
                        break;
                    case '2': // giam theo tien
                        $price = $price - $coupon->value;
                        break;
                    default:
                        break;
                }
                $coupon->update(['status' => '2']);
                return response()->json([
                    'message' => 'successfully',
                    'price' => $price,
                ], 200);
            }
        }
        else{
            return response()->json([
                'message' => 'Đã được sử dụng',
            ], 500);
        }
    }
}
