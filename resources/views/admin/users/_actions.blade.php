@include('admin.components._actions', [
    'id'         => $row->id,
    'module'     => 'user',
    'canDelete'  => $row->id !== auth()->id(),
])
