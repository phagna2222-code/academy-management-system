<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Academy;
use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SemesterController extends Controller
{
    public function index()
    {
        return view('admin.semesters.index');
    }

    public function data()
    {
        $q = Semester::query()
            ->select(['semesters.*'])
            ->with(['academy:id,name', 'academicYear:id,name']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Semester $r) => $r->academy?->name)
            ->addColumn('academic_year_name', fn (Semester $r) => $r->academicYear?->name)
            ->editColumn('start_date', fn (Semester $r) => $r->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn (Semester $r) => $r->end_date?->format('Y-m-d'))
            ->editColumn('status', fn (Semester $r) => view('admin.semesters._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Semester $r) => view('admin.semesters._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.semesters.create', [
            'semester' => new Semester,
            'academies' => Academy::orderBy('name')->get(),
            'academicYears' => AcademicYear::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Semester::create($this->validated($request));
        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.semesters.index');
    }

    public function edit(Semester $semester)
    {
        return view('admin.semesters.edit', [
            'semester' => $semester,
            'academies' => Academy::orderBy('name')->get(),
            'academicYears' => AcademicYear::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Semester $semester)
    {
        $semester->update($this->validated($request));
        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.semesters.index');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,closed'],
        ]);
    }
}
