<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\UploadImageUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $imageUser;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, UploadImageUser $imageUser)
    {
        $this->userRepository = $userRepository;
        $this->imageUser = $imageUser;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->get('start');
            $length = $request->get('length') ?? 10;
            $filter = $request->get('search');
            $search = (isset($filter['value']))? $filter['value'] : false;

            $total_members = User::count();

            $data = array(
                'recordsTotal' => $total_members,
                'recordsFiltered' => $total_members,
                'data' => $this->userRepository->dataTables($search, $length, ((int)$start/10) + 1),
            );

            return json_encode($data);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id, ['tags', 'category', 'role']);
        if (request()->ajax()) {
            $categories = Category::all();
            $roles = Role::where('name', '!=', 'Admin')->get();

            return view('users.user_profile', compact('user', 'categories', 'roles'));
        } else {
            return view('users.show', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->update($id, $request);

        return $this->jsonSuccess($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

    public function userTag($userId)
    {
        $tags = Tag::all();
        $user = $this->userRepository->find($userId, ['tags']);

        return view('users.user_tag', compact('user', 'tags'));
    }

    public function addHashtag(Request $request, $userId)
    {
        $user = $this->userRepository->find($userId);
        $user->tags()->sync($request->get('tag_ids'));

        return $this->jsonSuccess('Success');
    }

    public function uploadImages(Request $request, $id)
    {
        $request->validate([
            'images.*' => 'mimes:jpeg,jpg,png|max:10000',
        ]);
        if (!$request->has('images')) return ;

        $this->imageUser->execute($request->images, $id);
    }
}
