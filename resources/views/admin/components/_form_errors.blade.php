@php
    $bag = $errors ?? null;
@endphp
@if($bag && method_exists($bag, 'any') && $bag->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($bag->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif
