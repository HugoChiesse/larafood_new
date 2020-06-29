<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    protected $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Planos';
        $plans = $this->repository->orderBy('name')->paginate();
        return view('admin.pages.plans.index', compact('plans', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Plano';
        return view('admin.pages.plans.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('plans.index')->with('success', 'Plano cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Descrição do Plano';
        $plan = $this->repository->find($id);
        if (!$plan) {
            return redirect()->back()->with('danger', 'Não foi possível visualizar o plano com o código informado');
        }
        return view('admin.pages.plans.show', compact('title', 'plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Editar Plano';
        $plan = $this->repository->find($id);
        if (!$plan) {
            return redirect()->back()->with('danger', 'O código informado para o plano não existe!');
        }
        return view('admin.pages.plans.edit', compact('title', 'plan'));
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PlanRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $id)
    {
        $plan = $this->repository->find($id);
        if (!$plan) {
            return redirect()->back()->with('warning', 'Não foi possível atualizar plano, tente outra vez!');
        }
        $plan->update($request->all());
        return redirect()->route('plans.index')->with('success', 'O plano foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = $this->repository->find($id);
        if (!$plan) {
            return redirect()->back()->with('danger', 'Não foi possível deletar o plano solicitado, tente outra vez');
        }
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plano deletado com sucesso!');
    }

    /**
     * Search Plans
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $title = 'Planos';
        $plans = $this->repository->search($request->filter);
        return view('admin.pages.plans.index', compact('title', 'plans', 'filters'));
    }
}
