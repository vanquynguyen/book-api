<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookRepositoryInterface as BookRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Helpers\helper;

class BookController extends Controller
{
    private $userRepository;

    public function __construct(
        BookRepository $bookRepository
    )
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookRepository->getAll();

        return response()->json($books);
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
        try {
            $filename = helper::upload($request->file('image'), config('settings.bookPath'));
            $books = [
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'image' => $filename,
                'description' => $request->description,
                'author' => $request->author,
                'price' => $request->price,
                'amount' => $request->amount,
                'status' => config('settings.status.inprogress'),
            ];

            $books = $this->bookRepository->create($books);

            return response()->json($books);
        } catch (Exception $e) {
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
        $books = $this->bookRepository->show($id);

        return response()->json($books);
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
            var_dump($request->all());
            $books = $request->all();
            $filename = helper::upload($request->file('image'), config('settings.bookPath'));
            $books = $this->bookRepository->update($books, $id);

            return response()->json($books);
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
        try {
            $books = $this->bookRepository->destroy($id);
  
            return response()->json($books);
        } catch (Exception $e) {
            $response['error'] = true;

            return response()->json($response);
        }
    }

    public function search(Request $request) {
        $keywork = Input::get('keywork');
        if($keywork !== '') {
            $books = $this->bookRepository->search($keywork);
        }

        return response()->json($books);
    }

    public function getUserBook($id)
    {
        $books = Book::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return response()->json($books);
    }

    public function getBook()
    {
        $newBooks = $this->bookRepository->getNewBook();

        return response()->json($newBooks);

        // return response()->json([
        //     'newBooks' => $newBooks,
        //     // 'user' => $user,
        //     // 'token' => $token,
        // ]); 
    }

    public function searchUserBook(Request $request, $id) {
        $keywork = Input::get('keywork');
        $books = Book::where('user_id', $id)->where('title', 'like', '%'. $keywork .'%')->get();

        return response()->json($books);
    }
    
    public function bookFilter(Request $request) {
        $books = Book::where('category_id', $request->category_id)->get();

        return response()->json($books);
    }
    
}
