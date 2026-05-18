<?php

namespace App\Livewire;

use App\Http\Middleware\SetLocale;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $locale = 'en';

    public function mount(): void
    {
        $this->locale = app()->getLocale();
    }

    public function switchLocale(string $locale): void
    {
        if (! in_array($locale, SetLocale::SUPPORTED, true)) {
            return;
        }

        $this->locale = $locale;
        session(['locale' => $locale]);
        app()->setLocale($locale);
        cookie()->queue('locale', $locale, 60 * 24 * 365);

        // Tell the rest of the page to re-render with new translations.
        $this->dispatch('locale-changed', locale: $locale);
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
