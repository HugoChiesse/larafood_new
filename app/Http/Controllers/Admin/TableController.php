<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Mesas";
        $tables = $this->repository->orderBy('identify')->paginate();
        return view('admin.pages.tables.index', compact('title', 'tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar Nova Mesa";
        return view('admin.pages.tables.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('tables.index')->with('success', 'Mesa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código informado da mesa não foi localizado em nossa base de dados!');
        }
        $title = "Detalhes da Mesa |{$table->identify}|";
        return view('admin.pages.tables.show', compact('title', 'table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código informado da mesa não foi localizado em nossa base de dados!');
        }
        $title = "Editar a Mesa |{$table->identify}|";
        return view('admin.pages.tables.edit', compact('title', 'table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TableRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TableRequest $request, $id)
    {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código informado da mesa não foi localizado em nossa base de dados!');
        }
        $table->update($request->all());
        return redirect()->route('tables.index')->with('success', 'Mesa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código informado da mesa não foi localizado em nossa base de dados!');
        }
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Mesa deletada com sucesso!');
    }
}
