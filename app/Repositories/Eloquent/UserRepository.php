<?php
namespace App\Repositories\Eloquent;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll($select = ['*'])
    {
        $users = User::select($select)->orderBy('created_at', 'desc')->get();
       
        return $users;
    }

    public function getAllUser($select = ['*'], $paginate = [])
    {
        $users = User::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $users;
    }

    public function create($data)
    {
        $users = User::create($data);

        return $users;
    }

    public function show($id)
    {
        $users = User::findOrFail($id);

        return $users;
    }

    public function update($data, $id)
    {
        $users = User::find($id)->update($data);
        
        return $users;
    }

    public function destroy($id)
    {
        $users = User::find($id)->delete();
        
        return $users;
    }

    public function approve($data, $id)
    {
        $users = User::find($id)->update($data);

        return $users;
    }

    public function search($keywork)
    {
        $users = User::Where('full_name', 'like', '%'. $keywork .'%')->get();

        return $users;
    }
}