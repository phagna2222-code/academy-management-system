<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\ClassRoom;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClassRoomController extends Controller
{
    public function index()
    {
        return view('admin.class-rooms.index');
    }

    public function data()
    {
        $q = ClassRoom::query()
            ->select(['class_rooms.*'])
            ->with([
                'academy:id,name', 'campus:id,name', 'program:id,name',
                'subject:id,name', 'teacher:id,name', 'academicYear:id,name',
            ]);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('campus_name', fn (ClassRoom $r) => $r->campus?->name)
            ->addColumn('program_name', fn (ClassRoom $r) => $r->program?->name)
            ->addColumn('subject_name', fn (ClassRoom $r) => $r->subject?->name)
            ->addColumn('teacher_name', fn (ClassRoom $r) => $r->teacher?->name)
            ->addColumn('academic_year_name', fn (ClassRoom $r) => $r->academicYear?->name)
            ->editColumn('start_date', fn (ClassRoom $r) => $r->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn (ClassRoom $r) => $r->end_date?->format('Y-m-d'))
            ->editColumn('status', fn (ClassRoom $r) => view('admin.class-rooms._status', ['row' => $r])->render())
            ->addColumn('actions', fn (ClassRoom $r) => view('admin.class-rooms._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.class-rooms.create', $this->relations(new ClassRoom));
    }

    public function store(Request $request)
    {
        ClassRoom::create($this->validated($request));
        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.class-rooms.index');
    }

    public function edit(ClassRoom $classRoom)
    {
        return view('admin.class-rooms.edit', $this->relations($classRoom));
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
        $classRoom->update($this->validated($request, $classRoom->id));
        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.class-rooms.index');
    }

    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function relations(ClassRoom $model): array
    {
        return [
            'classRoom' => $model,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'programs' => Program::orderBy('name')->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'academicYears' => AcademicYear::orderBy('name')->get(),
            'semesters' => Semester::orderBy('name')->get(),
            'teachers' => Teacher::orderBy('name')->get(),
        ];
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'semester_id' => ['nullable', 'exists:semesters,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'class_code' => ['required', 'string', 'max:50', 'unique:class_rooms,class_code'.($id ? ",$id" : '')],
            'name' => ['required', 'string', 'max:255'],
            'room_no' => ['nullable', 'string', 'max:50'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'max_students' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,closed,inactive'],
        ]);
    }
}
