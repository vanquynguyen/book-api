<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Book;
use Stripe;
use Mail;

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

                $book = Book::find($cart->book_id);
                $amountOld = $book->amount;
                $amountNew = $amountOld - $cart->amount;
                $book->amount = $amountNew;
                $book = $book->save();
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
        try {
            $stripe = Stripe::setApiKey("sk_test_t9fbK0JjHn8vnCIZZXRSPkxC");
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => "4242424242424242",
                    'exp_month' => 4,
                    'exp_year' => 2019,
                    'cvc' => "314",
                ],
            ]);
            if (!isset($token['id'])) {
                return back();
            }
            $order = Order::find($id);
          
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'usd',
                'amount' => $order->total_price,
                'description' => 'success',
            ]);

            $order->status = 1;
            $order = $order->save();
            $response = 'success';

            return response()->json($response);
            // Mail::to($request->email)->send(new MailBooking($booking));
        } catch (Exception $e) {
            $response['error'] = true;

            return response()->json($response);
        }
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

    public function filterStatus(Request $request) {
        $status = Input::get('status');
        $orders = Order::where('status', $status)->get();
        return response()->json($orders);
    }

    public function getHistoryOrder($id) {
        $orders = Order::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return response()->json($orders);
    }
}
