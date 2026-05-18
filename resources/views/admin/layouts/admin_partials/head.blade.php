<!doctype html>
<html lang="{{ app()->getLocale() }}" class="minimal-theme" data-locale="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/backend') }}/assets/images/favicon-32x32.png" type="image/png" />

    {{-- plugins --}}
    <link href="{{ asset('assets/backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('assets/backend') }}/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/backend/assets/plugins/bootstrap-icons/font/bootstrap-icons.css') }}">

    {{-- loader --}}
    <link href="{{ asset('assets/backend') }}/assets/css/pace.min.css" rel="stylesheet" />

    {{-- Theme Styles --}}
    <link href="{{ asset('assets/backend') }}/assets/css/dark-theme.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/css/light-theme.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/css/semi-dark.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/css/header-colors.css" rel="stylesheet" />

    {{-- Plugins for forms / tables --}}
    <link href="{{ asset('assets/backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/plugins/tom-select/tom-select.bootstrap5.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/backend') }}/assets/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" />

    {{-- Khmer font helper --}}
    <style>
        html[lang="km"] body,
        html[data-locale="km"] body { font-family: 'Noto Sans Khmer', 'Roboto', system-ui, sans-serif; }
    </style>

    <title>@yield('pageTitle', __('app.brand'))</title>

    @livewireStyles

    @stack('styles')
</head>
