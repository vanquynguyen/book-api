<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $method = $request->method;
            if ($method == 0) {
                $status = 1;
            } else {
                $status = 0;
            }

            $order = new Order();
            $order->fill($request->all());
            $order->status = $status;
            $order->save();
            $orderId = $order->id;
            $carts = Cart::Where('user_id', $request->user_id)->get();

            foreach ($carts as $cart) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $orderId;
                $orderDetail->book_id = $cart->book_id;
                $orderDetail->amount = $cart->amount;
                $orderDetail->price = $cart->price;
                $orderDetail->save();
            }

            $customer = new Customer();
            $customer->fill($request->all());
            $customer->order_id = $order->id;
            $customer->save();

            DB::commit();
            // Mail::to($request->email)->send(new MailOrder($Order));
            $carts = Cart::Where('user_id', $request->user_id)->delete();
            $response['status'] = $status;
            return response()->json([
                'status' => $response,
                'orderId' => $orderId
            ]);
        } catch (Exception $e) {
            DB::rollback();
            $response['error'] = true;
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
