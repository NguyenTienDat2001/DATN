<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //
    public function addcart(Request $request){
        $user_id = $request->get('user_id');
        // Log::info($user_id);
        $book_id = $request->get('book_id');
        $quantity = $request->get('quantity');
        $cart = Order::where('user_id', $user_id)->where('status', '-1')->first();
        if ($cart) {
            $order_id = $cart->id;
            $exist_book = OrderDetail::where('order_id', $order_id)->where('book_id', $book_id)->first();
            if ($exist_book) {
                OrderDetail::where('id', $exist_book->id)->update(['quantity'=>$exist_book->quantity+$quantity]);
            } else {
                OrderDetail::create(['order_id'=>$order_id, 'book_id'=>$book_id, 'quantity'=>$quantity]);
            }
            return response()->json(['message' => 'update successfully', ], 200);
            
        } else {
            $newcart = Order::create(['user_id'=>$user_id, 'status'=> '-1', ]);
            OrderDetail::create(['order_id'=>$newcart->id, 'book_id'=>$book_id, 'quantity'=>$quantity, ]);
            return response()->json(['message' => 'new cart', ], 200);
        }
        
    }

    public function getcart(Request $request){
        $user_id = $request->get('user_id');
        $order = Order::where('user_id', $user_id)->where('status', '-1')->first();
        if($order) {
            $cart = OrderDetail::where('order_id', $order->id)->get();
            foreach($cart as $item) {
                $book = Book::where('id', $item->book_id)->first();
                $item->name = $book->name;
                $item->price = $book->sell_price;
                $item->img = $book->img;
                $item->author = $book->author;
            }
            return response()->json(['data' => $cart], 200);
        }
        else {
            return response()->json(['message' => 'Empty cart'], 201);
        }
    }

    public function updatecart($book_id, $scope){
        $order = Order::where('user_id', 1)->where('status', '-1')->first();
        $bookitem = OrderDetail::where('order_id', $order->id)->where('book_id', $book_id)->first();
        if($scope == 'inc'){
            $bookitem->quantity +=1;
        } 
        else {
            $bookitem->quantity -=1;
        }
        $bookitem->update();
        return response()->json([
            'status'=> 200,
            'message'=>'sucessfully',
            'data'=>$bookitem,
        ]);
    }

    public function deletecart($book_id){
        $order = Order::where('user_id', 1)->first();
        $bookitem = OrderDetail::where('order_id', $order->id)->where('book_id', $book_id)->first();
        $bookitem->delete();
        return response()->json([
            'status'=> 200,
            'message'=>'sucessfully',
        ]);
    }

    public function getOrder(){
        $orders = Order::where('status','!=', '-1')->get();
        foreach($orders as $order){
            $user = User::where('id', $order->user_id)->first();
            $order->email = $user->email;
        }
        return response()->json([
            'status'=> 200,
            'message'=>'sucessfully',
            'data' => $orders,
        ]);
    }

    public function getOrderByUser($id){
        $orders = Order::where('user_id', $id)->get();
        foreach ($orders as $order) {
            $orderitems = OrderDetail::where('order_id', $order->id)->get();
            foreach($orderitems as $item){
                $product = Book::where('id', $item->book_id)->first();
                $item->name = $product->name;
            }
            $order->infor = $orderitems;
        }
        return response()->json([
            'message'=>'sucessfully',
            'data' => $orders,
        ], 200);

    }

    public function getOrderInfor($order_id){
        $order = Order::where('id', $order_id)->first();
        $orderitems = OrderDetail::where('order_id', $order_id)->get();
        foreach($orderitems as $item){
            $product = Book::where('id', $item->book_id)->first();
            $item->name = $product->name;
        }
        if($order->status == 0){
            $trans = Transaction::where('order_id', $order_id)->first();
            if($trans){
                return response()->json([
                    'status'=> 200,
                    'message'=>'sucessfully',
                    'items' => $orderitems,
                    'trans' => $trans,
                ]);
            } else {
                return response()->json([
                    'status'=> 200,
                    'message'=>'sucessfully',
                    'items' => $orderitems,
                    'cash' => 'ok'
                ]);
            }
        } else {
            return response()->json([
                'status'=> 200,
                'message'=>'sucessfully',
                'items' => $orderitems,
            ]);
        }

    }
}
