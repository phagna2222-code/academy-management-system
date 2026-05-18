<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index');
    }

    public function data()
    {
        $q = Permission::query()->select(['id', 'module', 'name', 'slug', 'description', 'created_at']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('actions', fn (Permission $p) => view('admin.permissions._actions', ['row' => $p])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
