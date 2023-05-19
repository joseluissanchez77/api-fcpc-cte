<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ConflictException;
use App\Http\Controllers\Controller;
use App\Models\Models\Customer;
use App\Traits\RestResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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

        $company = Customer::select();
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

            $customer = new Customer($request->all());
            $customer->save();
            DB::commit();
            return $this->success($customer);
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
    public function show(Customer $customer)
    {
        $query = new Customer();

        return $query->findOrFail($customer->id);
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
    public function update(Request $request, Customer $customer)
    {
        DB::beginTransaction();
        try {
            $customer->fill($request->all());
            $customer->save();

            DB::commit();
            return $this->success($customer);
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
    public function destroy(Customer $customer)
    {
        DB::beginTransaction();
        try {
            $customer->fill($customer->toArray());

            $customer->delete(); 

            DB::commit();

            return $this->success($customer);
            // return $this->information(__('messages.success'));
        } catch (Exception $ex) {
            DB::rollBack();
            throw new ConflictException($ex->getMessage());
        }
    }
}
