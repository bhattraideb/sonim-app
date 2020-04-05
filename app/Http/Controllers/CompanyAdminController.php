<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $query  = CompanyAdmin::query();
        if($id != null){
            $query = $query->where('company_id', '=', $id);
        }
        $admins = $query->with('company')
            ->get();
        return view('admin.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::where('status', 'active')
            ->get();
        return view('admin.create')
            ->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $data = $request->only('name', 'email', 'company_id', 'contact_number', 'status');
            $rules = [
                'company_id'     => 'required|integer',
                'name'           => 'required|max:255',
                'email'          => 'required|email',
                'contact_number' => 'required|numeric',
                'status'         => 'required',
            ];
            $validator  = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = $validator->messages();
                return redirect()->back()->withErrors($errors);
            }

            $create = CompanyAdmin::create([
                'company_id'        => $request->company_id,
                'name'              => $request->name,
                'email'             => $request->email,
                'contact_number'    => $request->contact_number,
                'status'            => $request->status ?? 'inactive',
            ]);

            if($create){
                Session::flash('success', 'New admin added successfully.');
                return redirect(route('admin.list'));
            }else{
                Session::flash('failed', 'Adding new admin failed.');
                return redirect(route('admin.list'));
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyAdmin  $companyAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyAdmin $companyAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyAdmin  $companyAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyAdmin $companyAdmin, $id)
    {
        $companies = Company::where('status', 'active')
            ->get();
        $admin  = CompanyAdmin::where('id', $id)
            ->firstOrFail();
        return view('admin.edit')
            ->with([
                'admin'     => $admin,
                'companies' => $companies,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyAdmin  $companyAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyAdmin $companyAdmin)
    {
        try
        {
            $data = request()->validate([
                'company_id'     => 'required|integer',
                'name'           => 'required|max:255',
                'email'          => 'required|email',
                'contact_number' => 'required|numeric',
                'status'         => 'required',
            ]);

            $update = $companyAdmin->update($data);

            if($update){
                Session::flash('success', 'Admin updated successfully.');
                return redirect(route('admin.list'));
            }else{
                Session::flash('failed', 'Failed to  updated admin.');
                return redirect(route('admin.list'));
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyAdmin  $companyAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyAdmin $companyAdmin, $id)
    {
        try
        {
            $delete = CompanyAdmin::destroy($id);

            if($delete){
                Session::flash('success', 'Admin deleted successfully.');
                return response()->json([
                    'success' => true,
                    'company_id' => $id,
                ],200);
            }else{
                Session::flash('failed', 'Failed to  delete admin.');
                return response()->json([
                    'success' => false,
                    'company_id' => $id,
                ],200);
            }
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
    }
}
