<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company as Company;
use App\Http\Requests\AddCompanyRequest;
use Cookie;

class AdminCompaniesController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getCompanies()
  {
    $data['companies'] = Company::all()->toArray();

    return view('admin.companies.view', $data);
  }


  public function addCompany()
  {
    return view('admin.companies.add');
  }

  public function editCompany($id)
  {
    $data['company'] = Company::where('id', $id)->first();

    return view('admin.companies.edit', $data);
  }

  public function add(AddCompanyRequest $request)
  {
    $inputs = $request->input();
    $company = new Company();
    $company->c_name = $inputs['name'];

    $company->save();

    $status = success_msg('Successfully added a company');

    return redirect()->route('admin.companies.get')->with('status', $status );

  }

  public function update(AddCompanyRequest $request, $id)
  {
    $inputs = $request->input();
    $category = Company::where('id', $id)->first();
    $category->c_name = $inputs['name'];

    $category->save();

    $status = success_msg('Successfully updated the company');

    return redirect()->route('admin.companies.get')->with('status', $status );
  }

  public function delete($id)
  {

    $category = Company::where('id', $id)->get()->first();
    $category->delete();

    $status = success_msg('Successfully deleted the company');

    return $status;
  }

}
