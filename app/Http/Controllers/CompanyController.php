<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\SiteSetting;
use Exception;

class CompanyController extends Controller
{
    public function index()
    {
        // for ($i = 0; $i < 10; $i++) { 
        //     if ($i % 2 == 0) {
        //         echo 'st<br/>';
        //     }
        //     echo $i . '<br/>';
        // }
        // die();
        $data['keys'] = SiteSetting::$keys;
        $data['site_settings'] = SiteSetting::all();
        return view('company.create', $data);
    }

    public function store(CompanyRequest $request)
    {
        try {
            foreach(SiteSetting::$keys as $key => $value)
            $data = saveModel(new Company, $request);
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
