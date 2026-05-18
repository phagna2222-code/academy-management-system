<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function data(Request $request)
    {
        $query = User::query()
            ->select(['users.*'])
            ->with(['academy:id,name', 'campus:id,name', 'roles:id,name,slug']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (User $u) => $u->academy?->name)
            ->addColumn('campus_name', fn (User $u) => $u->campus?->name)
            ->addColumn('role_list', fn (User $u) => $u->roles->pluck('name')->implode(', '))
            ->editColumn('status', fn (User $u) => view('admin.users._status', ['row' => $u])->render())
            ->editColumn('user_type', fn (User $u) => __('app.user_type.'.$u->user_type))
            ->addColumn('actions', fn (User $u) => view('admin.users._actions', ['row' => $u])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
