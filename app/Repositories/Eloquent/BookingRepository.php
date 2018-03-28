<?php
namespace App\Repositories\Eloquent;
use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
class BookingRepository extends Repository implements BookingRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAllBooking($select = ['*'], $paginate = 5)
    {
        $bookings = Booking::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $bookings;
    }

    public function create($data)
    {
        $bookings = Booking::create($data);

        return $bookings;
    }

    public function show($id)
    {
        $bookings = Booking::findOrFail($id);

        return $bookings;
    }

    public function update($data, $id)
    {
        $bookings = Booking::find($id)->update($data);
        
        return $bookings;
    }

    public function destroy($id)
    {
        $bookings = Booking::find($id)->delete();
        
        return $bookings;
    }
}