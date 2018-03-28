<?php
namespace App\Repositories\Contracts;
interface BookingRepositoryInterface extends RepositoryInterface
{
    public function getAllBooking($select = ['*'], $paginate = 5);
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id); 
}