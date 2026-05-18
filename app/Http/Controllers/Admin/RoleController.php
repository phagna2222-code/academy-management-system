<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function create()
    {
        return view('admin.roles.create', [
            'role' => new Role,
            'academies' => Academy::orderBy('name')->get(),
            'permissions' => Permission::orderBy('module')->orderBy('name')->get()->groupBy('module'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $perms = $data['permissions'] ?? [];
        unset($data['permissions']);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $role = Role::create($data);
        $role->permissions()->sync($perms);

        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'academies' => Academy::orderBy('name')->get(),
            'permissions' => Permission::orderBy('module')->orderBy('name')->get()->groupBy('module'),
            'attached' => $role->permissions()->pluck('permissions.id')->all(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $this->validated($request, $role->id);
        $perms = $data['permissions'] ?? [];
        unset($data['permissions']);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $role->update($data);
        $role->permissions()->sync($perms);

        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'academy_id' => ['nullable', 'exists:academies,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);
    }
}
