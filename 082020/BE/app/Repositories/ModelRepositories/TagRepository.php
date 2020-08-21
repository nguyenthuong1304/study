<?php


namespace App\Repositories\ModelRepositories;


use App\Models\Tag;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagRepository extends AbstractModelRepository implements TagRepositoryInterface
{
    public function model()
    {
        return new Tag();
    }

    public function getData($with = [])
    {

    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function updateOrCreate($data, $id = null)
    {
        $object = $this->find($id);
        if ($object) return tap($object)->update($data);

        return $this->model()->create($data);
    }

    public function paginate($with = [], $condition = [])
    {
        return $this->model()
            ->where($condition)
            ->with($with)
            ->withCount('users')
            ->paginate(10);
    }
}
