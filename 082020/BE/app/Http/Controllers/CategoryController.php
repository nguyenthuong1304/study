<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $categories = Category::withCount('users')->orderBy('priority')->get();
        if ($request->ajax()) {
            $hashTag = Tag::limit(10)->get();
            
            return $this->jsonSuccess([
                'categories' => $categories,
                'tags' => $hashTag,
            ]);
        }

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $object = $this->categoryRepository->find($id);

        return view('categories._form', compact('object'));
    }
    
    public function update(CategoryRequest $request, $id)
    {
        return $this->categoryRepository->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);

        return back()->with('success', 'Item created successfully!');
    }

    public function getCategoriesAndCountUser()
    {
        $data = Category::withCount('users')->get();
        return $this->jsonSuccess($data);
    }
}
