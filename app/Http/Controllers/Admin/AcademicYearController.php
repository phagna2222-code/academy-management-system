<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Academy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearController extends Controller
{
    public function index()
    {
        return view('admin.academic-years.index');
    }

    public function data()
    {
        $q = AcademicYear::query()
            ->select(['academic_years.*'])
            ->with(['academy:id,name']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (AcademicYear $r) => $r->academy?->name)
            ->editColumn('is_current', fn (AcademicYear $r) => $r->is_current ? __('app.common.yes') : __('app.common.no'))
            ->editColumn('start_date', fn (AcademicYear $r) => $r->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn (AcademicYear $r) => $r->end_date?->format('Y-m-d'))
            ->editColumn('status', fn (AcademicYear $r) => view('admin.academic-years._status', ['row' => $r])->render())
            ->addColumn('actions', fn (AcademicYear $r) => view('admin.academic-years._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.academic-years.create', [
            'academicYear' => new AcademicYear,
            'academies' => Academy::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_current'] = $request->boolean('is_current');
        AcademicYear::create($data);

        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.academic-years.index');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic-years.edit', [
            'academicYear' => $academicYear,
            'academies' => Academy::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $data = $this->validated($request);
        $data['is_current'] = $request->boolean('is_current');
        $academicYear->update($data);

        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.academic-years.index');
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'in:active,closed'],
        ]);
    }
}
