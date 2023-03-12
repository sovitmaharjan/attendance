<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Requests\Branch\StoreBranchRequest;
use App\Models\Branch;

class BranchController extends Controller
{
    protected $helper;

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
        return view('branch.create', compact('page'));
    }

    public function store(StoreBranchRequest $request, Branch $branch)
    {
        try{
            $data = $this->helper->getObject($branch, $request);
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
        $data = Branch::findOrFail($id);
        return view('branch.edit', compact('page', 'data'));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $data = $this->helper->getObject($branch, $request);
        $data->update();
        return to_route('branch.index')->with('success', 'Branch has been updated');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id)->delete();
        return to_route('branch.index')->with('success', 'Branch has been deleted');
    }
}
