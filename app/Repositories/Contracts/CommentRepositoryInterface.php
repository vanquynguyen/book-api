<?php
namespace App\Repositories\Contracts;
interface CommentRepositoryInterface extends RepositoryInterface
{
    public function getAllComment($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}