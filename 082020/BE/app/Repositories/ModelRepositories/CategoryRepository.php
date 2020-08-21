<?php


namespace App\Repositories\ModelRepositories;


use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class CategoryRepository extends AbstractModelRepository implements CategoryRepositoryInterface
{
    public function model()
    {
        return new Category();
    }

    public function getData($with = [])
    {

    }

    public function find($id, $with = [])
    {
        return $this->model()
            ->with($with)
            ->findOrFail($id);
    }

    public function destroy($id)
    {
        return $this->find($id)->delete($id);
    }

    public function update($data, $id)
    {
        $cate = $this->find($id);

        return tap($cate)->update($data);
    }

}
