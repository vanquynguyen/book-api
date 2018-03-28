<?php
namespace App\Repositories\Contracts;
interface BookRepositoryInterface extends RepositoryInterface
{
    public function getAllBook($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}