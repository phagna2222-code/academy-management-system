@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.campuses.edit',
    'deleteRoute'  => 'admin.campuses.destroy',
    'editParam'    => 'campus',
])
