<?php

namespace App\Http\Controllers;

use App\Models\Models\Company;
use App\Models\Models\Establishment;
use App\Models\Models\PointEmission;
use Illuminate\Http\Request;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getEstableciemntoByCompania(Request $request)
    {
        $company = Company::findOrFail($request->company_id)->id;
        $establishment = Establishment::where('company_id', $company);
        return $establishment->count() == 0 ?  [] : $establishment->get();
    }
    public function getPuntoEmisiionByEstablecimiento(Request $request)
    {
        $establishment = Establishment::findOrFail($request->establishment_id)->id;
        $query = PointEmission::where('establishment_id', $establishment);
        return $query->count() == 0 ?  [] : $query->get();
    }
}
