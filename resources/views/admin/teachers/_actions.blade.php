@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.teachers.edit',
    'deleteRoute'  => 'admin.teachers.destroy',
    'editParam'    => 'teacher',
])
