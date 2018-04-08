<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $userId = Input::get('userId');
            $carts = Cart::where('user_id', $userId)->OrderBy('created_at', 'desc')->get();

            return response()->json($carts);
        } catch (Exception $e) {
            $response['error'] = true;

            return response()->json($response);
        }

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
        $book = Book::find($request->bookId);
        $carts = [
            'user_id' => $request->userId,
            'book_id' => $request->bookId,
            'title' => $book->title,
            'image' => $book->image,
            'price' => $book->price,
            'amount' => 1,
            'status' => 1

        ];

        $carts = Cart::create($carts);

        return response()->json($carts);
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
        $carts = Cart::findOrFail($id);
        // $carts->amount = $request->amount;
        // $carts->price = $request->price;
        $data = [
            'amount' => $request->amount,
            'price' => $request->price
        ];

        $carts = $carts->update($data);

        return response()->json($carts);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id)->delete();

        return response()->json($cart);
    }

    public function getBookId(Request $request)
    {
        $bookId = Input::get('bookId');
        $bookId = Cart::where('book_id', $bookId)->get();

        return $bookId;
    }
}

