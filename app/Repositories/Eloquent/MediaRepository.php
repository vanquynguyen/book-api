<?php
namespace App\Repositories\Eloquent;
use App\Models\Media;
use App\Repositories\Contracts\MediaRepositoryInterface;
class MediaRepository extends Repository implements MediaRepositoryInterface
{
    /**
     * @return mixed
     */

    public function getAllMedia($select = ['*'], $paginate = 5)
    {
        $medias = Media::select($select)->orderBy('created_at', 'desc')
            ->paginate($paginate);
       
        return $medias;
    }

    public function create($data)
    {
        $medias = Media::create($data);

        return $medias;
    }

    public function show($id)
    {
        $medias = Media::findOrFail($id);

        return $medias;
    }

    public function update($data, $id)
    {
        $medias = Media::find($id)->update($data);
        
        return $medias;
    }

    public function destroy($id)
    {
        $medias = Media::find($id)->delete();
        
        return $medias;
    }
}