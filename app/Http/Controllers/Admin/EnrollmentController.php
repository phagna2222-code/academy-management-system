<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Yajra\DataTables\Facades\DataTables;

class EnrollmentController extends Controller
{
    public function index()
    {
        return view('admin.enrollments.index');
    }

    public function data()
    {
        $q = Enrollment::query()
            ->select(['enrollments.*'])
            ->with([
                'academy:id,name', 'campus:id,name',
                'student:id,name,student_code',
                'classRoom:id,name,class_code',
                'academicYear:id,name', 'semester:id,name',
            ]);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('campus_name', fn (Enrollment $r) => $r->campus?->name)
            ->addColumn('student_name', fn (Enrollment $r) => trim(($r->student?->student_code ? '['.$r->student->student_code.'] ' : '').$r->student?->name))
            ->addColumn('class_room_name', fn (Enrollment $r) => $r->classRoom?->name)
            ->addColumn('academic_year_name', fn (Enrollment $r) => $r->academicYear?->name)
            ->addColumn('semester_name', fn (Enrollment $r) => $r->semester?->name)
            ->editColumn('enrollment_date', fn (Enrollment $r) => $r->enrollment_date?->format('Y-m-d'))
            ->editColumn('status', fn (Enrollment $r) => view('admin.enrollments._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Enrollment $r) => view('admin.enrollments._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
