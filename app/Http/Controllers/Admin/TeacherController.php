<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teachers.index');
    }

    public function data()
    {
        $q = Teacher::query()
            ->select(['teachers.*'])
            ->with(['academy:id,name', 'campus:id,name', 'user:id,name,email']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Teacher $r) => $r->academy?->name)
            ->addColumn('campus_name', fn (Teacher $r) => $r->campus?->name)
            ->editColumn('gender', fn (Teacher $r) => $r->gender ? __('app.gender.'.$r->gender) : '—')
            ->editColumn('joining_date', fn (Teacher $r) => $r->joining_date?->format('Y-m-d'))
            ->editColumn('status', fn (Teacher $r) => view('admin.teachers._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Teacher $r) => view('admin.teachers._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
