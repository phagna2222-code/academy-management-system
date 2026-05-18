<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearController extends Controller
{
    public function index()
    {
        return view('admin.academic-years.index');
    }

    public function data()
    {
        $q = AcademicYear::query()
            ->select(['academic_years.*'])
            ->with(['academy:id,name']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (AcademicYear $r) => $r->academy?->name)
            ->editColumn('is_current', fn (AcademicYear $r) => $r->is_current ? __('app.common.yes') : __('app.common.no'))
            ->editColumn('start_date', fn (AcademicYear $r) => $r->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn (AcademicYear $r) => $r->end_date?->format('Y-m-d'))
            ->editColumn('status', fn (AcademicYear $r) => view('admin.academic-years._status', ['row' => $r])->render())
            ->addColumn('actions', fn (AcademicYear $r) => view('admin.academic-years._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
