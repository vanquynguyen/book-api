<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Book;
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
        //
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
            $books = $request->all();
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

    public function approve($id)
    {
        $books = [
            'status' => config('settings.status.approved')
        ];

        $books = $this->bookRepository->update($books, $id);
        $books = $this->bookRepository->getAll();

        return response()->json($books);
    }

    public function search(Request $request) {
        $keywork = Input::get('keywork');
        $books = $this->bookRepository->search($keywork);

        return response()->json($books);
    }
}
