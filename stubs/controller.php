<?php

namespace App\Http\Controllers\ReplaceModule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModulesDirectory\ReplaceModule\ReplaceContract;

/**
 * Class ReplaceController
 * @package App\Http\Controllers\ReplaceModule
 */
class ReplaceController extends Controller
{
    /**
     * @var ReplaceContract
     */
    protected $service;

    /**
     * ReplaceController constructor.
     * 
     * @param ReplaceContract $service
     */
    public function __construct(ReplaceContract $service)
    {
        $this->service = $service;
    }

    /**
     * Display a paginated listing of the ReplacePlural.
     * 
     * By default the items per page are 20
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ReplacePlural = $this->service->get();
        
        return view('ReplacePlural.index', compact('ReplacePlural'));
    }
    
    /**
     * Show the form for creating a new ReplacePlural.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ReplacePlural.create');
    }
    
    /**
     * Store a newly created ReplaceSingular in storage.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->service->create($request->all());
        
        return redirect()
                ->route('ReplaceSingular.index');
    }

    /**
     * Display the specified ReplaceSingular
     * 
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ReplaceSingular = $this->service->find($id);
        
        return view('ReplacePlural.show', compact('ReplaceSingular'));
    }
    
    /**
     * Show the form for editing the specified ReplaceSingular.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ReplaceSingular = $this->service->find($id);
        
        return view('ReplacePlural.edit', compact('ReplaceSingular'));
    }

    /**
     * Update the specified ReplaceSingular in storage.
     * 
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->service->update($id, $request->all());
        
        return redirect()
                ->route('ReplaceSingular.index');
    }

    /**
     * Remove the specified ReplaceSingular from storage.
     * 
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $this->service->delete($id);
        
        return redirect()
                ->route('ReplaceSingular.index');
    }
}