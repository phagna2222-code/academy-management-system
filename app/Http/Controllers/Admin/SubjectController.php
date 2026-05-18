<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        return view('admin.subjects.index');
    }

    public function data()
    {
        $q = Subject::query()
            ->select(['subjects.*'])
            ->with(['academy:id,name', 'program:id,name']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Subject $r) => $r->academy?->name)
            ->addColumn('program_name', fn (Subject $r) => $r->program?->name)
            ->editColumn('status', fn (Subject $r) => view('admin.subjects._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Subject $r) => view('admin.subjects._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
