@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.academic-years.edit',
    'deleteRoute'  => 'admin.academic-years.destroy',
    'editParam'    => 'academicYear',
])
