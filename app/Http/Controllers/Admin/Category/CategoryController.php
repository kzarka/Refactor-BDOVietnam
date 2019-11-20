<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\CategoryServiceInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GameInputRequest;

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

    public function update(GameInputRequest $request, $id)
    {
        try {
            $result = $this->cateRepos->updateByAdmin($request->all(), $id);
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError([], $e->getMessage());
        }
    }

    public function store(GameInputRequest $request)
    {
        try {
            $result = $this->cateRepos->create($request->all());
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError([], $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $result = $this->cateRepos->deleteByAdmin($id);
        if($result) {
            $this->saveSessionSuccessMessage('Item deleted successfully.');
        } else {
            $this->saveSessionSuccessMessage('Item cannot be deleted.');
        }
        return redirect()->route('admin.category.index');
    }

    public function load(Request $request) {
        $categories = $this->catService->getCategoryList();
        return $this->respondWithSuccess($categories);
    }
}
