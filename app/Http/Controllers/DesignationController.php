<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\Designation;

class DesignationController extends Controller
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
        $page = "Designation";
        $data['records'] = Designation::all();
        return view('designation.index', $data, compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Designation";
        return view('designation.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Designation $designation)
    {
        $validated = $request->validate([
            'title' => 'required|unique:designations,title'
        ]);

        try{
            $data = $this->helper->getObject($designation, $request);
            $data->save();
            return back()->with('success', 'New Designation has been added');
         }catch(\Exception$e){
            return $this->$e->getMessage();
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
        $page = "Designation";
        $data = Designation::findOrFail($id);
        return view('designation.edit', compact('page', 'data'));
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
        $designation = Designation::findOrFail($id);
        $data = $this->helper->getObject($designation, $request);
        $data->update();
        return to_route('designation.index')->with('success', 'Designation has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designation::findOrFail($id)->delete();
        return to_route('designation.index')->with('success', 'Designation has been deleted');
    }
}
