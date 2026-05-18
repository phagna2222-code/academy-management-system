<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function data()
    {
        $q = Role::query()
            ->select(['roles.*'])
            ->with(['academy:id,name'])
            ->withCount('permissions');

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Role $r) => $r->academy?->name ?? __('app.common.all'))
            ->editColumn('status', fn (Role $r) => view('admin.roles._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Role $r) => view('admin.roles._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
