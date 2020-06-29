<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;

        $this->middleware(['can:profiles']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Perfis';
        $profiles = $this->repository->orderBy('name')->paginate();
        return view('admin.pages.profiles.index', compact('title', 'profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Perfil';
        return view('admin.pages.profiles.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('profiles.index')->with('success', 'Perfil cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Descrição do Perfil';
        $profile = $this->repository->find($id);
        if (!$profile) {
            return redirect()->back()->with('danger', 'O código do perfil informado não existe em nossa base de dados');
        }
        return view('admin.pages.profiles.show', compact('title', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Editar Perfil';
        $profile = $this->repository->find($id);
        if (!$profile) {
            return redirect()->back()->with('danger', 'O código do perfil informado não existe em nossa base de dados');
        }
        return view('admin.pages.profiles.edit', compact('title', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\ProfileRequest
     */
    public function update(ProfileRequest $request, $id)
    {
        $profile = $this->repository->find($id);
        if (!$profile) {
            return redirect()->back()->with('danger', 'O código do perfil informado não existe em nossa base de dados');
        }
        $profile->update($request->all());
        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->repository->find($id);
        if (!$profile) {
            return redirect()->back()->with('danger', 'O código do perfil informado não existe em nossa base de dados');
        }
        $profile->delete();
        return redirect()->route('profiles.index');
    }

    /**
     * Search Profile
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $title = 'Perfis';
        $profiles = $this->repository->search($request->filter);
        return view('admin.pages.profiles.index', compact('title', 'profiles'));
    }

    
}
