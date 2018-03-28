<?php
namespace App\Repositories\Eloquent;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Category::class;
    }
   
    public function getAllCategory($select = ['*'], $paginate = 5)
    {
        $categories = Category::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $categories;
    }

}