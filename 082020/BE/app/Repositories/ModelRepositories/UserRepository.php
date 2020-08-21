<?php


namespace App\Repositories\ModelRepositories;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\ModelRepositories\AbstractModelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRepository extends AbstractModelRepository implements UserRepositoryInterface
{
    public function model()
    {
        return new User();
    }

    public function getData($with = [], array $condition = [], Request $request = null)
    {
        return $this->model()
            ->with($with)
            ->where(function ($q){
                $q->where('id', '!=', 1)
                  ->Orwhere('email', '!=', 'admin@collection.com')
                  ->Orwhere('role_id', '!=', 1);
            })
            ->when($request->get('keyword'), function ($q) use ($condition, $request) {
                $q->where('last_name', 'LIKE', '%'. $request->get('keyword') .'%')
                  ->Orwhere('first_name', 'LIKE', '%'. $request->get('keyword') .'%');
            })
            ->when(count($condition), fn($q) => $q->where([$condition]))
            ->when($request->get('category'), fn($q) => $q->whereIn('category_id', $request->get('category')))
            ->paginate(10);
    }

    public function dataTables($search, $length, $page)
    {
        return $this->model()
            ->with('category', 'tags', 'role', 'information')
            ->where('email', '!=', 'admin@collection.com')
            ->when($search, function ($q) use ($search) {
                $q->where('last_name', 'LIKE', '%'. $search .'%')
                  ->Orwhere('first_name', 'LIKE', '%'. $search .'%');
            })
            ->paginate($length, ['*'], 'page', $page);
    }

    public function find($id, $with = [])
    {
        return $this->model()
            ->with($with)
            ->findOrFail($id);
    }

    public function destroy($id)
    {
        return $this->model()
            ->destroy($id);
    }

    public function update($id, $request)
    {
        $dataInformation = $request->only('price', 'hidden_price', 'address', 'bio', 'nickname', 'avatar', 'socials');
        if (!$request->has('hidden_price')) $dataInformation['hidden_price'] = 0;
        if ($request->hasFile('avatar')) {
            $dataInformation['avatar'] = substr($request->file('avatar')->store('public/avatars'), 7);
        }

        $user = $this->find($id);
        $user->update($request->all());
        $user->information()->updateOrCreate([
            'user_id' => $id
        ], $dataInformation);

        return $user;
    }

    public function addFavorite($userId)
    {
        return Auth::user()->favoriters()->attach($userId);
    }
}
