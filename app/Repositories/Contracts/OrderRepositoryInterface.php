<?php
namespace App\Repositories\Contracts;
interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getAllOrder($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}