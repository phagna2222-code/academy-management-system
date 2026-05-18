@php
    /** @var string $status */
    $map = [
        'active' => 'success', 'inactive' => 'secondary', 'blocked' => 'dark',
        'closed' => 'secondary', 'completed' => 'success',
        'dropped' => 'warning', 'transferred' => 'info', 'cancelled' => 'danger',
        'pending' => 'warning', 'submitted' => 'info', 'reviewed' => 'primary',
        'late' => 'warning', 'paid' => 'success', 'unpaid' => 'danger',
        'partial' => 'warning', 'draft' => 'secondary', 'published' => 'success',
        'approved' => 'success', 'rejected' => 'danger', 'resigned' => 'dark',
        'success' => 'success', 'failed' => 'danger',
    ];
    $color = $map[$status] ?? 'secondary';
@endphp
<span class="badge bg-{{ $color }}">{{ __('app.status.'.$status) }}</span>
