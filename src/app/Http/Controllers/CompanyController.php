<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CompanyController extends Controller
{
    //
    public function show($id)
    {
        $company = Company::find($id);
        return view('pages.company.show', compact('company'));
    }


    public function edit($id)
    {
        $company = Company::find($id);
        return view('pages.company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',

        ]);

        $company->update($request->all());

        return redirect()->route('companies.show', $company->id ?? 1)->with('success', 'Company updated successfully');

    }
}
