<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
{
    public function index()
    {
        return view('admin.programs.index');
    }

    public function data()
    {
        $q = Program::query()
            ->select(['programs.*'])
            ->with(['academy:id,name', 'campus:id,name']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Program $r) => $r->academy?->name)
            ->addColumn('campus_name', fn (Program $r) => $r->campus?->name ?? '—')
            ->editColumn('status', fn (Program $r) => view('admin.programs._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Program $r) => view('admin.programs._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
