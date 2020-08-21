<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Http\Request;

class HashTagController extends Controller
{

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->paginate();

        return view('hashtags.index', compact('tags'));
    }

    public function update(Request $request, $id)
    {
        return $this->tagRepository->updateOrCreate($request->all(), $id);
    }
    
    public function destroy($id)
    {
        $msg = Tag::destroy($id) ? ['success', 'Xóa thành công'] : ['error', 'Xóa thất bại'];
        
        return redirect()->back()->with($msg[0], $msg[1]);
    }
}
