<?php
namespace App\Repositories\Eloquent;
use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
class CommentRepository extends Repository implements CommentRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAllComment($select = ['*'], $paginate = 5)
    {
        $comments = Comment::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $comments;
    }

    public function create($data)
    {
        $comments = Comment::create($data);

        return $comments;
    }

    public function show($id)
    {
        $comments = Comment::findOrFail($id);

        return $comments;
    }

    public function update($data, $id)
    {
        $comments = Comment::find($id)->update($data);
        
        return $comments;
    }

    public function destroy($id)
    {
        $comments = Comment::find($id)->delete();
        
        return $comments;
    }
}