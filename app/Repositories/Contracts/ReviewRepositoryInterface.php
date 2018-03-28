<?php
namespace App\Repositories\Contracts;
interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function getAllReview($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}