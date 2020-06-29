<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(Category $category)
    {
        $this->repository = $category;

        $this->middleware(['can:categories']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Categorias';
        $categories = $this->repository->orderBy('name')->paginate();
        return view('admin.pages.categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Nova Categoria';
        return view('admin.pages.categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('categories.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$category = $this->repository->find($id))
        {
            return redirect()->back()->with('danger', 'O código da categoria informado não consta em nossa base de dados!');
        }
        $title = "Detalhes da Categoria |{$category->name}|";
        return view('admin.pages.categories.show', compact('title', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$category = $this->repository->find($id))
        {
            return redirect()->back()->with('danger', 'O código da categoria informado não consta em nossa base de dados!');
        }
        $title = "Editar a Categoria |{$category->name}|";
        return view('admin.pages.categories.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if(!$category = $this->repository->find($id))
        {
            return redirect()->back()->with('danger', 'O código da categoria informado não consta em nossa base de dados!');
        }
        $category->update($request->all());
        return redirect()->route('categories.index')->with('succes', 'Categoria atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$category = $this->repository->find($id))
        {
            return redirect()->back()->with('danger', 'O código da categoria informado não consta em nossa base de dados!');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('succes', 'Categoria deletada com sucesso');
    }
}
