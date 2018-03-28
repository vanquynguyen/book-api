<?php
namespace App\Repositories\Contracts;
interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function getAllCustomer($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}