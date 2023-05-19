<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ConflictException;
use App\Http\Controllers\Controller;
use App\Models\Models\Company;
use App\Traits\RestResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    use RestResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = isset($request->sort) ? $request->sort : 'id';
        $type_sort = isset($request->type_sort) ? $request->type_sort : 'desc';
        $size = isset($request->size) ? $request->size : 100;

        $company = Company::select();
        $query =  $company->orderBy($sort, $type_sort)->paginate($size);

        return $this->success($query);

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
        DB::beginTransaction();
        try {

            $company = new Company($request->all());
            $company->save();
            DB::commit();
            return $this->success($company);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new ConflictException($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $query = new Company();

        return $query->findOrFail($company->id);
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
    public function update(Request $request, Company $company)
    {
        DB::beginTransaction();
        try {
            $company->fill($request->all());
            $company->save();

            DB::commit();
            return $this->success($company);
            // return $this->information(__('messages.success'));
        } catch (Exception $ex) {
            DB::rollBack();
            throw new ConflictException($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        DB::beginTransaction();
        try {
            $company->fill($company->toArray());
            // $area->estado_id = Catalogo::where('cat_keyword', 'INA')->first()->id_catalogo;
            // $area->save();
            $company->delete(); 

            DB::commit();

            return $this->success($company);
            // return $this->information(__('messages.success'));
        } catch (Exception $ex) {
            DB::rollBack();
            throw new ConflictException($ex->getMessage());
        }
    }
}
