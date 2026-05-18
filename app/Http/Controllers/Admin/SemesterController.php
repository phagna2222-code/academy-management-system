<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Yajra\DataTables\Facades\DataTables;

class SemesterController extends Controller
{
    public function index()
    {
        return view('admin.semesters.index');
    }

    public function data()
    {
        $q = Semester::query()
            ->select(['semesters.*'])
            ->with(['academy:id,name', 'academicYear:id,name']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Semester $r) => $r->academy?->name)
            ->addColumn('academic_year_name', fn (Semester $r) => $r->academicYear?->name)
            ->editColumn('start_date', fn (Semester $r) => $r->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn (Semester $r) => $r->end_date?->format('Y-m-d'))
            ->editColumn('status', fn (Semester $r) => view('admin.semesters._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Semester $r) => view('admin.semesters._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
