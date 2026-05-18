<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CampusController extends Controller
{
    public function index()
    {
        return view('admin.campuses.index');
    }

    public function data(Request $request)
    {
        $query = Campus::query()
            ->select(['campuses.*'])
            ->with(['academy:id,name', 'manager:id,name']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Campus $c) => $c->academy?->name)
            ->addColumn('manager_name', fn (Campus $c) => $c->manager?->name)
            ->editColumn('is_main', fn (Campus $c) => $c->is_main ? __('app.common.yes') : __('app.common.no'))
            ->editColumn('status', fn (Campus $c) => view('admin.campuses._status', ['row' => $c])->render())
            ->editColumn('created_at', fn (Campus $c) => $c->created_at?->format('Y-m-d H:i'))
            ->addColumn('actions', fn (Campus $c) => view('admin.campuses._actions', ['row' => $c])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
