<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ShiftAssignmentController extends Controller
{
    public function index()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['shift'] = Shift::orderBy('name', 'asc')->get();
        return view('shift-assignment.index', $data);
    }
}
