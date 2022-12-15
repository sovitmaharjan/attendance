<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Helper\Helper;
use App\Models\Company;
use Exception;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $data['page'] = "Company";
        $data['records'] = Company::all();
        return view('company.index', $data);
    }

    public function create()
    {
        $data['page'] = "Company";
        return view('company.create', $data);
    }

    public function store(CompanyRequest $request, Company $company)
    {
        try {
            $data = $this->helper->getObject($company, $request);
            $data->save();
            return back()->with('success', 'New company has been added');
        } catch (Exception $e) {
            return $this->$e->getMessage();
        }
    }

    public function edit($id)
    {
        $page = "Company";
        $data = Company::findOrFail($id);
        return view('company.edit', compact('page', 'data'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $data = $this->helper->getObject($company, $request);
        $data->update();
        return to_route('company.index')->with('success', 'Company has been updated');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id)->delete();
        return to_route('company.index')->with('success', 'Company has been deleted');
    }
}
