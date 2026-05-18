<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\User;
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

    public function create()
    {
        return view('admin.campuses.create', [
            'campus' => new Campus,
            'academies' => Academy::orderBy('name')->get(),
            'managers' => User::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Campus::create($data);

        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.campuses.index');
    }

    public function edit(Campus $campus)
    {
        return view('admin.campuses.edit', [
            'campus' => $campus,
            'academies' => Academy::orderBy('name')->get(),
            'managers' => User::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Campus $campus)
    {
        $data = $this->validated($request, $campus->id);
        $campus->update($data);

        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.campuses.index');
    }

    public function destroy(Campus $campus)
    {
        $campus->delete();

        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        $rules = [
            'academy_id' => ['required', 'exists:academies,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'is_main' => ['sometimes', 'boolean'],
            'status' => ['required', 'in:active,inactive'],
        ];

        $data = $request->validate($rules);
        $data['is_main'] = $request->boolean('is_main');

        return $data;
    }
}
