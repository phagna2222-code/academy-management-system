<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function create()
    {
        return view('admin.users.create', [
            'user' => new User,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $roles = $data['roles'] ?? [];
        unset($data['roles'], $data['password_confirmation']);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $user->roles()->sync($roles);

        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validated($request, $user->id);
        $roles = $data['roles'] ?? [];
        unset($data['roles'], $data['password_confirmation']);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        $user->roles()->sync($roles);

        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            sweetalert()->warning(__('app.not_authorized'));

            return back();
        }

        $user->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        $rules = [
            'academy_id' => ['nullable', 'exists:academies,id'],
            'campus_id' => ['nullable', 'exists:campuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'.($id ? ",$id" : '')],
            'phone' => ['nullable', 'string', 'max:50'],
            'user_type' => ['required', 'in:super_admin,admin,teacher,student,finance'],
            'status' => ['required', 'in:active,inactive,blocked'],
            'password' => [$id ? 'nullable' : 'required', 'confirmed', 'min:6'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
        ];

        return $request->validate($rules);
    }
}
