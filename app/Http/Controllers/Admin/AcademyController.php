<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AcademyController extends Controller
{
    public function index()
    {
        return view('admin.academies.index');
    }

    public function data(Request $request)
    {
        $query = Academy::query()->select([
            'id', 'name', 'code', 'owner_name', 'phone', 'email', 'status', 'created_at',
        ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', fn (Academy $a) => view('admin.academies._status', ['row' => $a])->render())
            ->editColumn('created_at', fn (Academy $a) => $a->created_at?->format('Y-m-d H:i'))
            ->addColumn('actions', fn (Academy $a) => view('admin.academies._actions', ['row' => $a])->render())
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.academies.create', ['academy' => new Academy]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Academy::create($data);

        sweetalert()->success(__('app.created_successfully'));

        return redirect()->route('admin.academies.index');
    }

    public function edit(Academy $academy)
    {
        return view('admin.academies.edit', compact('academy'));
    }

    public function update(Request $request, Academy $academy)
    {
        $data = $this->validated($request, $academy->id);
        $academy->update($data);

        sweetalert()->success(__('app.updated_successfully'));

        return redirect()->route('admin.academies.index');
    }

    public function destroy(Academy $academy)
    {
        $academy->delete();

        sweetalert()->success(__('app.deleted_successfully'));

        return back();
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:academies,code'.($id ? ",$id" : '')],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
}
