<?php
namespace App\Repositories\Contracts;
interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAll($select = ['*']);
    public function getAllUser($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function search($keywwork);
    public function approve($data, $id);
    public function update($data, $id);
    public function destroy($id); 
}