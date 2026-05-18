<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\Program;
use Illuminate\Http\Request;
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

    public function create()
    {
        return view('admin.programs.create', [
            'program' => new Program,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Program::create($this->validated($request));
        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.programs.index');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', [
            'program' => $program,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $program->update($this->validated($request));
        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.programs.index');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['nullable', 'exists:campuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'duration_years' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
}
