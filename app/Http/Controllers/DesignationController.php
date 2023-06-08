<?php

namespace App\Http\Controllers;

use App\Http\Requests\Designation\StoreDesignationRequest;
use App\Http\Requests\Designation\UpdateDesignationRequest;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $page = "Designation";
        $data['records'] = Designation::all();
        return view('designation.index', $data, compact('page'));
    }

    public function create()
    {
        $page = "Designation";
        return view('designation.create', compact('page'));
    }

    public function store(StoreDesignationRequest $request, Designation $designation)
    {
        try {
            $data = getObject($designation, $request);
            $data->save();
            return back()->with('success', 'New Designation has been added');
        } catch (\Exception $e) {
            return $this->$e->getMessage();
        }
    }

    public function edit(Designation $designation)
    {
        $page = "Designation";
        $data = $designation;
        return view('designation.edit', compact('page', 'data'));
    }

    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $data = getObject($designation, $request);
        $data->update();
        return back()->with('success', 'Designation has been updated');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();
        return to_route('designation.index')->with('success', 'Designation has been deleted');
    }
}
