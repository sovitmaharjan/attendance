<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\Branch\StoreBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Models\Branch;
use Exception;

class BranchController extends Controller
{
    protected $helper;

    function __construct()
    {
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

    public function show(Branch $branch)
    {
        return response()->json($branch->load('departments', 'employees'));
    }

    public function store(StoreBranchRequest $request, Branch $branch)
    {
        try {
            $data = $this->helper->getObject($branch, $request);
            $data->save();
            return back()->with('success', 'New Branch has been added');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Branch $branch)
    {
        $page = "Branch";
        $data = $branch;
        return view('branch.edit', compact('page', 'data'));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        try {
            $data = $this->helper->getObject($branch, $request);
            $data->update();
            return back()->with('success', 'Branch has been updated');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return to_route('branch.index')->with('success', 'Branch has been deleted');
    }
}
