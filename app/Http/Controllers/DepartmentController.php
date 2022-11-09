<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Requests\DepartmentRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;

class DepartmentController extends Controller
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
        $page = "Department";
        $data['records'] = Department::all();
        return view('department.index', $data, compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Department";
        $company = Company::all();
        $branch = Branch::all();
        return view('department.create', compact('page', 'company', 'branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request, Department $department)
    {
        try{
            $data = $this->helper->getObject($department, $request);
            $data['company_id'] = $request->company_id;
            $data['branch_id'] = $request->branch_id;
            $data->save();
            return back()->with('success', 'New Department has been added');
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
        $page = "Department";
        $company = Company::all();
        $branch = Branch::all();
        $data = Department::findOrFail($id);
        return view('department.edit', compact('page', 'data', 'company', 'branch'));
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
        $company = Department::findOrFail($id);
        $data = $this->helper->getObject($company, $request);
        $data['company_id'] = $request->company_id;
        $data['branch_id'] = $request->branch_id;
        $data->update();
        return to_route('department.index')->with('success', 'Department has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Department::findOrFail($id)->delete();
        return to_route('department.index')->with('success', 'Department has been deleted');
    }
}
