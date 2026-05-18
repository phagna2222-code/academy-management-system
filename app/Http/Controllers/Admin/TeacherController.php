<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teachers.index');
    }

    public function data()
    {
        $q = Teacher::query()
            ->select(['teachers.*'])
            ->with(['academy:id,name', 'campus:id,name', 'user:id,name,email']);

        return DataTables::eloquent($q)
            ->addIndexColumn()
            ->addColumn('academy_name', fn (Teacher $r) => $r->academy?->name)
            ->addColumn('campus_name', fn (Teacher $r) => $r->campus?->name)
            ->editColumn('gender', fn (Teacher $r) => $r->gender ? __('app.gender.'.$r->gender) : '—')
            ->editColumn('joining_date', fn (Teacher $r) => $r->joining_date?->format('Y-m-d'))
            ->editColumn('status', fn (Teacher $r) => view('admin.teachers._status', ['row' => $r])->render())
            ->addColumn('actions', fn (Teacher $r) => view('admin.teachers._actions', ['row' => $r])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.teachers.create', [
            'teacher' => new Teacher,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'users' => User::where('user_type', 'teacher')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Teacher::create($this->validated($request));
        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.teachers.index');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', [
            'teacher' => $teacher,
            'academies' => Academy::orderBy('name')->get(),
            'campuses' => Campus::orderBy('name')->get(),
            'users' => User::where('user_type', 'teacher')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($this->validated($request, $teacher->id));
        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.teachers.index');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'teacher_code' => ['required', 'string', 'max:50', 'unique:teachers,teacher_code'.($id ? ",$id" : '')],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female'],
            'dob' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'joining_date' => ['nullable', 'date'],
            'salary_type' => ['required', 'in:fixed,per_class,per_session'],
            'salary_amount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,inactive,resigned'],
        ]);
    }
}
