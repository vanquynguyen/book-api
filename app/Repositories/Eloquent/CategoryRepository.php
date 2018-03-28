<?php
namespace App\Repositories\Eloquent;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAllCategory($select = ['*'], $paginate = 5)
    {
        $categories = Category::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $categories;
    }

    public function create($data)
    {
        $categories = Category::create($data);

        return $categories;
    }

    public function show($id)
    {
        $categories = Category::findOrFail($id);

        return $categories;
    }

    public function update($data, $id)
    {
        $categories = Category::find($id)->update($data);
        
        return $categories;
    }

    public function destroy($id)
    {
        $categories = Category::find($id)->delete();
        
        return $categories;
    }
}