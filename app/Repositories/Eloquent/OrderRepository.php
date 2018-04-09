<?php
namespace App\Repositories\Eloquent;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
class OrderRepository extends Repository implements OrderRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAllOrder($select = ['*'], $paginate = 5)
    {
        $orders = Order::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $orders;
    }

    public function create($data)
    {
        $orders = Order::create($data);

        return $orders;
    }

    public function show($id)
    {
        $orders = Order::findOrFail($id);

        return $orders;
    }

    public function update($data, $id)
    {
        $orders = Order::find($id)->update($data);
        
        return $orders;
    }

    public function destroy($id)
    {
        $orders = Order::find($id)->delete();
        
        return $orders;
    }
}