<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\ClassRoom;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EnrollmentController extends Controller
{
    public function index()
    {
        return view('admin.enrollments.index');
    }

    public function data()
    {
        $q = Enrollment::query()
            ->select(['enrollments.*'])
            ->with([
                'academy:id,name', 'campus:id,name',
                'student:id,name,student_code',
                'classRoom:id,name,class_code',
                'academicYear:id,name', 'semester:id,name',
            ]);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('campus_name', fn (Enrollment $r) => $r->campus?->name)
            ->addColumn('student_name', fn (Enrollment $r) => trim(($r->student?->student_code ? '['.$r->student->student_code.'] ' : '').$r->student?->name))
            ->addColumn('class_room_name', fn (Enrollment $r) => $r->classRoom?->name)
            ->addColumn('academic_year_name', fn (Enrollment $r) => $r->academicYear?->name)
            ->addColumn('semester_name', fn (Enrollment $r) => $r->semester?->name)
            ->editColumn('enrollment_date', fn (Enrollment $r) => $r->enrollment_date?->format('Y-m-d'))
            ->editColumn('status', fn (Enrollment $r) => view('admin.enrollments._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Enrollment $r) => view('admin.enrollments._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.enrollments.create', $this->relations(new Enrollment));
    }

    public function store(Request $request)
    {
        Enrollment::create($this->validated($request));
        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.enrollments.index');
    }

    public function edit(Enrollment $enrollment)
    {
        return view('admin.enrollments.edit', $this->relations($enrollment));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $enrollment->update($this->validated($request, $enrollment->id));
        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.enrollments.index');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function relations(Enrollment $model): array
    {
        return [
            'enrollment' => $model,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'academicYears' => AcademicYear::orderBy('name')->get(),
            'semesters' => Semester::orderBy('name')->get(),
            'programs' => Program::orderBy('name')->get(),
            'classRooms' => ClassRoom::orderBy('name')->get(),
            'students' => Student::orderBy('name')->get(),
        ];
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'semester_id' => ['nullable', 'exists:semesters,id'],
            'program_id' => ['nullable', 'exists:programs,id'],
            'class_room_id' => ['required', 'exists:class_rooms,id'],
            'student_id' => ['required', 'exists:students,id'],
            'enrollment_no' => ['required', 'string', 'max:50', 'unique:enrollments,enrollment_no'.($id ? ",$id" : '')],
            'enrollment_date' => ['required', 'date'],
            'status' => ['required', 'in:active,completed,dropped,transferred,cancelled'],
        ]);
    }
}
