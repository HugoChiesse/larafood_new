<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;

        $this->middleware(['can:permissions']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Permissões";
        $permissions = $this->repository->orderBy('name')->paginate();
        return view('admin.pages.permissions.index', compact('title', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Nova Permissão';
        return view('admin.pages.permissions.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permissão criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detalhe da Permissão';
        $permission = $this->repository->find($id);
        if (!$permission) {
            return redirect()->back()->with('danger', 'O código da permissão informado não foi localizado na base de dados.');
        }
        return view('admin.pages.permissions.show', compact('title', 'permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Editar Permissão';
        $permission = $this->repository->find($id);
        if (!$permission) {
            return redirect()->back()->with('danger', 'O código da permissão informado não foi localizado na base de dados.');
        }
        return view('admin.pages.permissions.edit', compact('title', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PermissionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = $this->repository->find($id);
        if (!$permission) {
            return redirect()->back()->with('danger', 'O código da permissão informado não foi localizado na base de dados.');
        }
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permissão atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->repository->find($id);
        if (!$permission) {
            return redirect()->back()->with('danger', 'O código da permissão informado não foi localizado na base de dados.');
        }
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permissão removida com sucesso!');
    }

    public function search(Request $request)
    {
        $title = "Permissões";
        $filters = $request->except('_token');
        $permissions = $this->repository->search($request->filter);
        return view('admin.pages.permissions.index', compact('title', 'filters', 'permissions'));
    }
}
