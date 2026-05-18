@php
    /** @var int $id */
    /** @var string $module     Livewire event prefix (e.g. 'academy'). */
    /** @var bool $canEdit      Whether to render the edit button. */
    /** @var bool $canDelete    Whether to render the delete button. */
    $canEdit   = $canEdit   ?? true;
    $canDelete = $canDelete ?? true;
@endphp
<div class="d-inline-flex gap-1">
    @if($canEdit)
        <button type="button"
                class="btn btn-sm btn-outline-primary js-livewire-edit"
                data-module="{{ $module }}"
                data-id="{{ $id }}"
                title="{{ __('app.actions.edit') }}">
            <i class="bi bi-pencil"></i>
        </button>
    @endif
    @if($canDelete)
        <button type="button"
                class="btn btn-sm btn-outline-danger js-livewire-delete"
                data-module="{{ $module }}"
                data-id="{{ $id }}"
                title="{{ __('app.actions.delete') }}">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>
