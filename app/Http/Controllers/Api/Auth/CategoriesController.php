<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoriesController extends Controller
{
    private $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll(['*']);

        return response()->json($categories);
    }
   
}
