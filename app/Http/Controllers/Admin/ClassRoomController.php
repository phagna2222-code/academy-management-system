<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Yajra\DataTables\Facades\DataTables;

class ClassRoomController extends Controller
{
    public function index()
    {
        return view('admin.class-rooms.index');
    }

    public function data()
    {
        $q = ClassRoom::query()
            ->select(['class_rooms.*'])
            ->with([
                'academy:id,name', 'campus:id,name', 'program:id,name',
                'subject:id,name', 'teacher:id,name', 'academicYear:id,name',
            ]);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('campus_name', fn (ClassRoom $r) => $r->campus?->name)
            ->addColumn('program_name', fn (ClassRoom $r) => $r->program?->name)
            ->addColumn('subject_name', fn (ClassRoom $r) => $r->subject?->name)
            ->addColumn('teacher_name', fn (ClassRoom $r) => $r->teacher?->name)
            ->addColumn('academic_year_name', fn (ClassRoom $r) => $r->academicYear?->name)
            ->editColumn('start_date', fn (ClassRoom $r) => $r->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn (ClassRoom $r) => $r->end_date?->format('Y-m-d'))
            ->editColumn('status', fn (ClassRoom $r) => view('admin.class-rooms._status', ['row' => $r])->render())
            ->addColumn('actions', fn (ClassRoom $r) => view('admin.class-rooms._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
