@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.subjects.edit',
    'deleteRoute'  => 'admin.subjects.destroy',
    'editParam'    => 'subject',
])
