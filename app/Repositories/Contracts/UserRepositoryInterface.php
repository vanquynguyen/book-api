<?php
namespace App\Repositories\Contracts;
interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllUser($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}