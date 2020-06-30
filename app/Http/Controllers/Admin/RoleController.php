<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $repository;

    public function __construct(Role $role)
    {
        $this->repository = $role;

        $this->middleware(['can:roles']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Cargos";
        $roles = $this->repository->orderBy('name')->paginate();
        return view('admin.pages.roles.index', compact('title', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar Novo Cargo";
        return view('admin.pages.roles.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('roles.index')->with('success', 'Cargo cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do cargo informado não consta em nossa base de dados!');
        }
        $title = "Detalhes do Cargo |{$role->name}|";
        return view('admin.pages.roles.show', compact('title', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do cargo informado não consta em nossa base de dados!');
        }
        $title = "Editar o Cargo |{$role->name}|";
        return view('admin.pages.roles.edit', compact('title', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do cargo informado não consta em nossa base de dados!');
        }
        $role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Cargo alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código do cargo informado não consta em nossa base de dados!');
        }
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Cargo deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $title = "Cargos";
        $filters = $request->except('_token');
        $roles = $this->repository->search($request->filter);
        return view('admin.pages.roles.index', compact('title', 'roles', 'filters'));
    }
}
