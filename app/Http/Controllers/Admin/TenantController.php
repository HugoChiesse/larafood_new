<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    protected $repository;

    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant->id;
        $title = "Dados da Empresa";
        $tenant = $this->repository->find($tenantId);
        return view('admin.pages.tenants.index', compact('title', 'tenant'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código da empresa informado não consta em nossa base de dados!');
        }
        $title = "Detalhes da Empresa |{$tenant->name}|";
        return view('admin.pages.tenants.show', compact('title', 'tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código da empresa informado não consta em nossa base de dados!');
        }
        $title = "Editar a Empresa |{$tenant->name}|";
        return view('admin.pages.tenants.edit', compact('title', 'tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TenantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TenantRequest $request, $id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'O código da empresa informado não consta em nossa base de dados!');
        }
        $data = $request->all();

        if ($request->hasFile('logo') && $request->logo->isValid()) {

            if (Storage::exists($tenant->logo)) {
                Storage::delete($tenant->logo);
            }

            $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}");
        }

        $tenant->update($data);
        return redirect()->route('tenants.index')->with('success', 'Dados da empresa atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()->with('danger', 'Empresa deleta com sucesso');
        }
        $tenant->delete();
        return redirect()->back()->with('success', 'Empresa deletada com sucesso!');
    }
}
