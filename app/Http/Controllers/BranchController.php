<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
use App\Helper\Helper;
use App\Models\Branch;
use App\Models\Company;

class BranchController extends Controller
{

    function __construct(){
        $this->helper = new Helper;
     }

    public function index()
    {
        $page = "Branch";
        $data['records'] = Branch::all();
        return view('branch.index', $data, compact('page'));
    }

    public function create()
    {
        $page = "Branch";
        $company = Company::all();
        return view('branch.create', compact('page', 'company'));
    }

    public function store(BranchRequest $request, Branch $branch)
    {
        try{
            $data = $this->helper->getObject($branch, $request);
            $data['company_id'] = $request->company_id;
            $data->save();
            return back()->with('success', 'New Branch has been added');
         }catch(\Exception$e){
            return $e->getMessage();
         }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page = "Branch";
        $company = Company::all();
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('page', 'branch', 'company'));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $data = $this->helper->getObject($branch, $request);
        $data['company_id'] = $request->company_id;
        $data->update();
        return to_route('branch.index')->with('success', 'Branch has been updated');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id)->delete();
        return to_route('branch.index')->with('success', 'Branch has been deleted');
    }
}
