@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.class-rooms.edit',
    'deleteRoute'  => 'admin.class-rooms.destroy',
    'editParam'    => 'classRoom',
])
