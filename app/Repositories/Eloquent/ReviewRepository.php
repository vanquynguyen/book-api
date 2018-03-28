<?php
namespace App\Repositories\Eloquent;
use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;
class ReviewRepository extends Repository implements ReviewRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAllReview($select = ['*'], $paginate = 5)
    {
        $reviews = Review::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $reviews;
    }

    public function create($data)
    {
        $reviews = Review::create($data);

        return $reviews;
    }

    public function show($id)
    {
        $reviews = Review::findOrFail($id);

        return $reviews;
    }

    public function update($data, $id)
    {
        $reviews = Review::find($id)->update($data);
        
        return $reviews;
    }

    public function destroy($id)
    {
        $reviews = Review::find($id)->delete();
        
        return $reviews;
    }
}