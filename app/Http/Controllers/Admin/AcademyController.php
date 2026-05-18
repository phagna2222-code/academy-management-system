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
}
