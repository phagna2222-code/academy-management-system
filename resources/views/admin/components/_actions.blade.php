@php
    /** @var int $id */
    /** @var string $editRoute */
    /** @var string $deleteRoute */
    /** @var string $editParam */
@endphp
<div class="d-inline-flex gap-1">
    @if(!empty($editRoute) && \Illuminate\Support\Facades\Route::has($editRoute))
        <a href="{{ route($editRoute, [$editParam => $id]) }}" class="btn btn-sm btn-outline-primary" title="{{ __('app.actions.edit') }}">
            <i class="bi bi-pencil"></i>
        </a>
    @endif
    @if(!empty($deleteRoute) && \Illuminate\Support\Facades\Route::has($deleteRoute))
        <a href="{{ route($deleteRoute, [$editParam => $id]) }}"
           class="btn btn-sm btn-outline-danger js-confirm-delete"
           data-action="{{ route($deleteRoute, [$editParam => $id]) }}"
           title="{{ __('app.actions.delete') }}">
            <i class="bi bi-trash"></i>
        </a>
    @endif
</div>
