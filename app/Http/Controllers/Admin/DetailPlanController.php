<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailsPlanRequest;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $detailPlan, $plan;
    
    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->detailPlan = $detailPlan;
        $this->plan = $plan;

        $this->middleware(['can:plan']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('danger', 'O código do plano informado não consta em nossa base de dados!');
        }
        $details = $plan->details()->orderBy('name')->paginate();
        $title = "Detalhes do Plano |{$plan->name}|";
        return view('admin.pages.plans.details.index', compact('details', 'title', 'plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('danger', 'O código do plano informado não consta em nossa base de dados!');
        }
        $title = "Adicionar Novo Detalhe ao Plano |{$plan->name}|";
        return view('admin.pages.plans.details.create', compact('title', 'plan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DetailsPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetailsPlanRequest $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('danger', 'O código do plano informado não consta em nossa base de dados!');
        }
        $plan->details()->create($request->all());
        return redirect()->route('details.index', $plan->id)->with('success', 'Detalhe cadastrado ao plano!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idPlan, $idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->detailPlan->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back()->with('danger', 'O código do plano e/ou do detalhe informado(s) não consta(m) em nossa base de dados!');
        }
        $title = "Visualizar Detalhe do Plano |{$plan->name}|";
        return view('admin.pages.plans.details.show', compact('title', 'plan', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idPlan, $idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->detailPlan->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back()->with('danger', 'O código do plano e/ou do detalhe informado(s) não consta(m) em nossa base de dados!');
        }
        $title = "Editar Detalhe do Plano |{$plan->name}|";
        return view('admin.pages.plans.details.edit', compact('title', 'plan', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\DetailsPlanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DetailsPlanRequest $request, $idPlan, $idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->detailPlan->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back()->with('danger', 'O código do plano e/ou do detalhe informado(s) não consta(m) em nossa base de dados!');
        }
        $detail->update($request->all());
        return redirect()->route('details.index', $plan->id)->with('success', 'Detalhe do plano foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPlan, $idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->detailPlan->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back()->with('danger', 'O código do plano e/ou do detalhe informado(s) não consta(m) em nossa base de dados!');
        }
        $detail->delete();
        return redirect()->route('details.index', $plan->id)->with('success', 'Detalhe do plano foi deletado com sucesso!');
    }
}
