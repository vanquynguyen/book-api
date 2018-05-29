<?php
namespace App\Repositories\Eloquent;
use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;
class BookRepository extends Repository implements BookRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAll($select = ['*'])
    {
        $books = Book::select($select)->orderBy('created_at', 'desc')->get();
       
        return $books;
    }

    public function getAllBook($select = ['*'], $paginate = 5)
    {
        $books = Book::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $books;
    }

    public function getNewBook()
    {
        $books = Book::where('status', 1)->orderBy('created_at', 'desc')->take(9)->random()->get();
       
        return $books;
    }

    public function create($data)
    {
        $books = Book::create($data);

        return $books;
    }

    public function show($id)
    {
        $books = Book::findOrFail($id);

        return $books;
    }

    public function update($data, $id)
    {
        $books = Book::find($id)->update($data);
        
        return $books;
    }

    public function approve($data, $id)
    {
        $books = Book::find($id)->update($data);

        return $books;
    }

    public function destroy($id)
    {
        $books = Book::find($id)->delete();
        
        return $books;
    }

    public function search($keywork)
    {
        $books = Book::Where('title', 'like', '%'. $keywork .'%')->get();

        return $books;
    }
}