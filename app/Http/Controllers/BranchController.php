<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;
use App\Models\Branch;
use App\Models\Company;

class BranchController extends Controller
{

    function __construct(){
        $this->helper = new Helper;
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Branch";
        $data['records'] = Branch::all();
        return view('branch.index', $data, compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Branch";
        $company = Company::all();
        return view('branch.create', compact('page', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $page = "Branch";
        $company = Company::all();
        $data = Branch::findOrFail($id);
        return view('branch.edit', compact('page', 'data', 'company'));
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
        $company = Branch::findOrFail($id);
        $data = $this->helper->getObject($company, $request);
        $data['company_id'] = $request->company_id;
        $data->update();
        return to_route('branch.index')->with('success', 'Branch has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Branch::findOrFail($id)->delete();
        return to_route('branch.index')->with('success', 'Branch has been deleted');
    }
}
