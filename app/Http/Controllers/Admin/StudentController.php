<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.students.index');
    }

    public function data()
    {
        $q = Student::query()
            ->select(['students.*'])
            ->with(['academy:id,name', 'campus:id,name', 'user:id,name,email']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Student $r) => $r->academy?->name)
            ->addColumn('campus_name', fn (Student $r) => $r->campus?->name)
            ->editColumn('gender', fn (Student $r) => $r->gender ? __('app.gender.'.$r->gender) : '—')
            ->editColumn('admission_date', fn (Student $r) => $r->admission_date?->format('Y-m-d'))
            ->editColumn('status', fn (Student $r) => view('admin.students._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Student $r) => view('admin.students._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.students.create', [
            'student' => new Student,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'users' => User::where('user_type', 'student')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Student::create($this->validated($request));
        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', [
            'student' => $student,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'users' => User::where('user_type', 'student')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $student->update($this->validated($request, $student->id));
        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'student_code' => ['required', 'string', 'max:50', 'unique:students,student_code'.($id ? ",$id" : '')],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female'],
            'dob' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'photo' => ['nullable', 'string'],
            'admission_date' => ['nullable', 'date'],
            'status' => ['required', 'in:active,inactive,blocked'],
        ]);
    }
}
