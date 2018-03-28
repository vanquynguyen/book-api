<?php
namespace App\Repositories\Eloquent;
use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAllCustomer($select = ['*'], $paginate = 5)
    {
        $customers = Customer::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $customers;
    }

    public function create($data)
    {
        $customers = Customer::create($data);

        return $customers;
    }

    public function show($id)
    {
        $customers = Customer::findOrFail($id);

        return $customers;
    }

    public function update($data, $id)
    {
        $customers = Customer::find($id)->update($data);
        
        return $customers;
    }

    public function destroy($id)
    {
        $customers = Customer::find($id)->delete();
        
        return $customers;
    }
}