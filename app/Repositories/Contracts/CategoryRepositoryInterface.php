<?php
namespace App\Repositories\Contracts;
interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getAll($select = ['*']);
    public function getAllCategory($select = ['*'], $paginate = []);
    public function create($data);
    public function show($id);
    public function search($keywwork);
    public function update($data, $id);
    public function destroy($id); 
}