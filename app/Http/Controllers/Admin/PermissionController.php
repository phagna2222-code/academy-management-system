<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function create()
    {
        return view('admin.permissions.create', ['permission' => new Permission]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['module'].'.'.$data['name'], '.');
        Permission::create($data);

        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $this->validated($request, $permission->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['module'].'.'.$data['name'], '.');
        $permission->update($data);

        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'module' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:permissions,slug'.($id ? ",$id" : '')],
            'description' => ['nullable', 'string'],
        ]);
    }
}
