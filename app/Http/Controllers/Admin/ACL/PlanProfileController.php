<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function profiles($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('warning' ,'O código que informou não está associado a nenhum plano!');
        }
        $title = "Perfil do Plano: |{$plan->name}|";
        $profiles = $plan->profiles()->orderBy('name')->paginate();
        return view('admin.pages.plans.profiles.profiles', compact('plan', 'title', 'profiles'));
    }

    public function createProfile(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('warning' ,'O código que informou não está associado a nenhum plano!');
        }
        $title = "Perfis Diponíveis ao Plano: |{$plan->name}|";
        $filters = $request->except('_token');
        $profiles = $plan->profilesNotAttach($request->filter);
        return view('admin.pages.plans.profiles.createProfile', compact('title', 'filters', 'profiles', 'plan'));
    }

    public function storeProfile(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('warning', 'O código que informou não está associado a nenhum plano!');
        }
        if (!$request->profiles || count($request->profiles) === 0) {
            return redirect()->back()->with('warning', 'Você precisa escolher pelo menos um perfil para associar ao plano!');
        }
        $plan->profiles()->attach($request->profiles);
        return redirect()->route('plans.profiles', $plan->id)->with('success', 'Perfil associado ao plano com sucesso!');
    }

    public function removeProfile($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);
        if (!$plan || !$profile) {
            return redirect()->back()->with('danger', 'Não existe nenhum perfil associado ao plano!');
        }
        $plan->profiles()->detach($profile);
        return redirect()->back()->with('success', 'A desassociação entre o plano e perfil efeturada com sucesso!');
    }
}
