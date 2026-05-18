<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.students.index');
    }

    public function data()
    {
        $q = Student::query()
            ->select(['students.*'])
            ->with(['academy:id,name', 'campus:id,name', 'user:id,name,email']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Student $r) => $r->academy?->name)
            ->addColumn('campus_name', fn (Student $r) => $r->campus?->name)
            ->editColumn('gender', fn (Student $r) => $r->gender ? __('app.gender.'.$r->gender) : '—')
            ->editColumn('admission_date', fn (Student $r) => $r->admission_date?->format('Y-m-d'))
            ->editColumn('status', fn (Student $r) => view('admin.students._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Student $r) => view('admin.students._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
