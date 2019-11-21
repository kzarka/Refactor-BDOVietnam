<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\CategoryServiceInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryInputRequest;

class CategoryController extends BaseController
{
	protected $catService, $catRepos;

	public function __construct(CategoryServiceInterface $catService, CategoryRepositoryInterface $catRepos)
    {
        $this->catService = $catService;
        $this->catRepos = $catRepos;
    }

    public function index(Request $request)
    {
    	$categories = $this->catService->getCategoryList();
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function update(CategoryInputRequest $request, $id)
    {
        try {
            $result = $this->catRepos->updateByAdmin($request->all(), $id);
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError([], $e->getMessage());
        }
    }

    public function store(CategoryInputRequest $request)
    {
        try {
            $result = $this->catRepos->create($request->all());
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError([], $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $result = $this->catRepos->deleteByAdmin($id);
        if($result) {
            $this->saveSessionSuccessMessage('Item deleted successfully.');
        } else {
            $this->saveSessionSuccessMessage('Item cannot be deleted.');
        }
        return redirect()->route('admin.category.index');
    }

    public function load(Request $request) {
        $categories = null;
        $exceptId = $request->get('id');
        \Log::info($exceptId);
        if($exceptId != null) {
            $categories = $this->catService->loadCategorySelect($exceptId);
        } else {
            $categories = $this->catService->getCategoryList();
        }
        return $this->respondWithSuccess($categories);
    }
}
