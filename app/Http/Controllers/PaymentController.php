<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    //Xu li yeu cau
    public function processpayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:3000/payment/infor". "?order_id=".$request->get('order_id');
        $vnp_TmnCode = "VF0KM5SS"; //Mã website tại VNPAY 
        $vnp_HashSecret = "IBYJVZILYOKGXVZSOSYNNPHHNJDIXATA"; //Chuỗi bí mật

        $vnp_TxnRef = $request->get('order_id'); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "thanh toan don hang";
        $vnp_OrderType = "bank";
        $vnp_Amount = $request->get('total_price') * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "";
        $vnp_IpAddr = request()->ip();
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        
        return $vnp_Url;
        // vui lòng tham khảo thêm tại code demo
    }

    public function getinfor($request){
        //
        // Log::infor("data is", $request->vnp_TxnRef);
        // dd($request->toArray());
        $transactionCode = $request->vnp_TxnRef;
        $bankCode = $request->vnp_BankCode;
        $money = (int) $request->vnp_Amount / 100;
        $vnpTranId = $request->vnp_TransactionNo; // Mã giao dịch tại VNPAY
        $vnpPayDate = $request->vnp_PayDate; // Ngày giao dịch
        // $date = date_create_from_format("YmdHis", $vnpPayDate);
        if ($request->vnp_ResponseCode == "00") {
            $status = "successful";
            Transaction::create([
                'type'=>'bank',
                'order_id'=>6,
                'bank_code'=>'NCB',
                'amount'=>100000,
                'infor'=>'ok',
            ]);
            // Log::infor($request);
        } else
            $status = "failed";
        return redirect("https://localhost:3000" . "/detail?payment_code=".$transactionCode."&money=".$money."&status=".$status);
    }

    public function createTran(Request $request){
        
        $tran = Transaction::create([
            'type'=>'bank',
            'order_id'=>$request->get('order_id'),
            'bank_code'=>$request->get('bank_code'),
            'amount'=>$request->get('amount'),
            'infor'=>$request->get('infor'),
        ]);
        $order = Order::where('id', $request->get('order_id'));
        $order->update(['status' => '0']);
        $events = Event::where('status', '1')->get();
        $total_point = 0;
        foreach($events as $event){
            $total_point += round($request->get('amount') / $event->value * $event->point);
        }
        $user = User::where('id', 1)->first();
        $new_point = $user->point+ $total_point;
        $user->update(['point'=> $new_point]);
        return response()->json([
            'message'=>'sucessfully',
            'tran' => $tran,
        ], 200);
    }
}
