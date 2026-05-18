@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.semesters.edit',
    'deleteRoute'  => 'admin.semesters.destroy',
    'editParam'    => 'semester',
])
