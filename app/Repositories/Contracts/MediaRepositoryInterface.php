<?php
namespace App\Repositories\Contracts;
interface MediaRepositoryInterface extends RepositoryInterface
{
    public function getAllMedia($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}