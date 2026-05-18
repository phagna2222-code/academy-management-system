@php
    /**
     * @var string $title           Card title.
     * @var string|null $createRoute Route name for "Add new" button (optional).
     * @var string $dataUrl         URL that returns DataTables JSON.
     * @var array  $columns          Array of ['data' => 'col', 'title' => 'X', 'orderable' => bool, 'searchable' => bool].
     * @var string $tableId         Unique ID for the <table>.
     * @var array  $order            DataTables order (e.g. [[0,'desc']]).
     */
    $tableId   = $tableId   ?? 'datatable';
    $order     = $order     ?? [[0, 'desc']];
    $columns   = $columns   ?? [];
    $createRoute = $createRoute ?? null;
@endphp

<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3 flex-wrap gap-2">
            <h5 class="mb-0">{{ $title }}</h5>
            <div class="ms-auto d-flex gap-2">
                @if($createRoute && \Illuminate\Support\Facades\Route::has($createRoute))
                    <a href="{{ route($createRoute) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.create') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table id="{{ $tableId }}" class="table table-striped table-hover align-middle" style="width:100%;">
                <thead>
                    <tr>
                        @foreach($columns as $c)
                            <th>{{ $c['title'] }}</th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!window.jQuery || !jQuery.fn.DataTable) return;

        jQuery('#{{ $tableId }}').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! $dataUrl !!}',
            columns: @json($columns),
            order: @json($order),
            pagingType: 'full_numbers',
            language: {
                processing: '...',
                search:     @json(__('app.actions.search') . ':'),
                lengthMenu: @json('_MENU_'),
                info:       @json('_START_ – _END_ / _TOTAL_'),
                infoEmpty:  @json(__('app.common.no_records')),
                emptyTable: @json(__('app.common.no_records')),
                paginate: {
                    first:    '«', last:     '»',
                    next:     '›', previous: '‹'
                }
            }
        });
    });
</script>
@endpush
