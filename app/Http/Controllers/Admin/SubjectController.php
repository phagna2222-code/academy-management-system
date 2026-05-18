<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        return view('admin.subjects.index');
    }

    public function data()
    {
        $q = Subject::query()
            ->select(['subjects.*'])
            ->with(['academy:id,name', 'program:id,name']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Subject $r) => $r->academy?->name)
            ->addColumn('program_name', fn (Subject $r) => $r->program?->name)
            ->editColumn('status', fn (Subject $r) => view('admin.subjects._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Subject $r) => view('admin.subjects._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.subjects.create', [
            'subject' => new Subject,
            'academies' => Academy::orderBy('name')->get(),
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Subject::create($this->validated($request));
        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.subjects.index');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', [
            'subject' => $subject,
            'academies' => Academy::orderBy('name')->get(),
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($this->validated($request));
        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.subjects.index');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'credit' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
}
