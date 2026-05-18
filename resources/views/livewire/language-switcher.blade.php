<div class="dropdown" wire:ignore.self>
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-translate"></i>
        <span class="ms-1 d-none d-md-inline">{{ strtoupper($locale) }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <button type="button" wire:click="switchLocale('en')" class="dropdown-item @if($locale==='en') active @endif">
                <i class="bi bi-check2 me-1 @if($locale!=='en') invisible @endif"></i>
                {{ __('app.english') }}
            </button>
        </li>
        <li>
            <button type="button" wire:click="switchLocale('km')" class="dropdown-item @if($locale==='km') active @endif">
                <i class="bi bi-check2 me-1 @if($locale!=='km') invisible @endif"></i>
                {{ __('app.khmer') }}
            </button>
        </li>
    </ul>
</div>
