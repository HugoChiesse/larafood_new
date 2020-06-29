<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Produtos";
        $products = $this->repository->orderBy('title')->paginate();
        return view('admin.pages.products.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar Novo Produto";
        return view('admin.pages.products.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $tenant = auth()->user()->tenant;
        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("tenant/{$tenant->uuid}/products");
        }
        $this->repository->create($data);
        return redirect()->route('products.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do produto informado não consta em nossa base de dados!');
        }
        $title = "Detalhes do Produto: |{$product->title}|";
        return view('admin.pages.products.show', compact('title', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do produto informado não consta em nossa base de dados!');
        }
        $title = "Editar o Produto: |{$product->title}|";
        return view('admin.pages.products.edit', compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $tenant = auth()->user()->tenant;
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do produto informado não consta em nossa base de dados!');
        }
        if ($request->hasFile('image') && $request->image->isValid()) {
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $data['image'] = $request->image->store("tenant/{$tenant->uuid}/products");
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do produto informado não consta em nossa base de dados!');
        }
        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $title = "Produtos";
        $filters = $request->except('_token');
        $products = $this->repository->search($request->filter);
        return view('admin.pages.products.index', compact('title', 'products', 'filters'));
    }
}
