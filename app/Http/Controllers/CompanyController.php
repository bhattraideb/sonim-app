<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index')
            ->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            $data = $request->only('name', 'email', 'address', 'contact_number', 'status');
            $rules = [
                'name'           => 'required|max:255',
                'email'          => 'required|email',
                'address'        => 'required|max:255',
                'contact_number' => 'required|numeric',
            ];
            $validator  = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = $validator->messages();
                return redirect()->back()->withErrors($errors);
            }

            $create = Company::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'address'           => $request->address,
                'contact_number'    => $request->contact_number,
                'status'            => $request->status ?? 'inactive',
            ]);

            if($create){
                Session::flash('success', 'New company added successfully.');
                return redirect(route('companies.list'));
            }else{
                Session::flash('failed', 'Adding new company failed.');
                return redirect(route('companies.list'));
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::where('id', $id)
            ->firstOrFail();
        return view('company.edit')
            ->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        try
        {
            $data = $request->only('name', 'email', 'address', 'contact_number', 'status');
            $rules = [
                'name'           => 'required|max:255',
                'email'          => 'required|email',
                'address'        => 'required|max:255',
                'contact_number' => 'required|numeric',
            ];
            $validator  = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = $validator->messages();
                return redirect()->back()->withErrors($errors);
            }

            $update = Company::where([
                ['id', $request->company_id],

            ])
                ->update([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'address'           => $request->address,
                    'contact_number'    => $request->contact_number,
                    'status'            => $request->status ?? 'inactive',
                ]);

            if($update){
                Session::flash('success', 'Company updated successfully.');
                return redirect(route('companies.list'));
            }else{
                Session::flash('failed', 'Failed to  updated company.');
                return redirect(route('companies.list'));
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, $id)
    {
        try
        {
            $user = Company::find($id);
            $delete = $user->delete();
            if($delete){
                Session::flash('success', 'Company deleted successfully.');
                return response()->json([
                    'success' => true,
                    'company_id' => $id,
                ],200);
            }else{
                Session::flash('failed', 'Failed to  delete company.');
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
