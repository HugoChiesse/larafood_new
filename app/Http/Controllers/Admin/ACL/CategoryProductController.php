<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function categories($idProduct)
    {
        if (!$product = $this->product->find($idProduct)) {
            return redirect()->back()->with('danger', 'O código do produto informado não consta em nossa base de dados!');
        }
        $title = "Categorias do Produto: |{$product->title}|";
        $categories = $product->categories()->orderBy('name')->paginate();
        return view('admin.pages.products.categories.categories', compact('title', 'categories', 'product'));
    }

    public function createCategory(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct)) {
            return redirect()->back()->with('warning', 'Não foi possível associar a(s) categoria(s) ao produto, tente mais tarde.');
        }
        $title = "Categorias Disponíveis Para o Produto: |{$product->title}|";
        $filters = $request->except('_token');
        $categories = $product->categoryNotAttach($request->filter);
        return view('admin.pages.products.categories.createCategory', compact('title', 'categories', 'product', 'filters'));
    }

    public function storeCategory(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct)) {
            return redirect()->back()->with('warning', 'Não foi possível associar a categoria ao produto, tente mais tarde.');
        }
        if (!$request->categories || count($request->categories) === 0) {
            return redirect()->back()->with('warning', 'Você precisa escolher pelo menos uma categoria!');
        }
        $product->categories()->attach($request->categories);
        return redirect()->route('products.categories', $product->id);
    }

    public function removeCategory($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);
        if (!$product || !$category) {
            return redirect()->back()->with('warning', 'O código do produto e/ou código da categoria não está(ão) correto(s)');
        }
        $product->categories()->detach($category);
        return redirect()->back()->with('success', 'Categoria desvinvulada com sucesso!');
    }
}
