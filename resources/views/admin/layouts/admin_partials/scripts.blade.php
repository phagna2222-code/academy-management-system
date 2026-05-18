{{-- Bootstrap bundle JS --}}
<script src="{{ asset('assets/backend') }}/assets/js/bootstrap.bundle.min.js"></script>

{{-- plugins --}}
<script src="{{ asset('assets/backend') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('assets/backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{ asset('assets/backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('assets/backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{ asset('assets/backend') }}/assets/js/pace.min.js"></script>

{{-- DataTables (BS5) --}}
<script src="{{ asset('assets/backend') }}/assets/plugins/datatables/dataTables.min.js"></script>
<script src="{{ asset('assets/backend') }}/assets/plugins/datatables/dataTables.bootstrap5.min.js"></script>

{{-- SweetAlert2 (delete confirms) --}}
<script src="{{ asset('assets/backend') }}/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

{{-- flatpickr (date/time) --}}
<script src="{{ asset('assets/backend') }}/assets/plugins/flatpickr/flatpickr.min.js"></script>

{{-- Tom Select (select fields) --}}
<script src="{{ asset('assets/backend') }}/assets/plugins/tom-select/tom-select.complete.min.js"></script>

{{-- app --}}
<script src="{{ asset('assets/backend') }}/assets/js/app.js"></script>

{{-- Global plugin auto-init + delete confirm helper --}}
<script>
    window.AMS = window.AMS || {};

    // i18n strings for SweetAlert2 (filled from server locale)
    window.AMS.i18n = {
        confirm_delete_title: @json(__('app.confirm_delete_title')),
        confirm_delete_text:  @json(__('app.confirm_delete_text')),
        yes_delete:           @json(__('app.yes_delete')),
        cancel:               @json(__('app.cancel')),
        deleted:              @json(__('app.deleted')),
    };

    // Initialise flatpickr + Tom Select within any container.
    window.AMS.initPlugins = function (root) {
        root = root || document;

        // flatpickr — any input with .flatpickr or [data-flatpickr]
        root.querySelectorAll('.flatpickr-date:not(.fp-ready), [data-flatpickr]:not(.fp-ready)').forEach(function (el) {
            var opts = { dateFormat: el.dataset.dateFormat || 'Y-m-d' };
            if (el.dataset.enableTime === '1' || el.classList.contains('flatpickr-datetime')) {
                opts.enableTime = true;
                opts.dateFormat = el.dataset.dateFormat || 'Y-m-d H:i';
            }
            if (el.dataset.timeOnly === '1') {
                opts.enableTime = true; opts.noCalendar = true;
                opts.dateFormat = 'H:i';
            }
            flatpickr(el, opts);
            el.classList.add('fp-ready');
        });

        // Tom Select — any .tom-select element. Use [data-ts-ready] sentinel
        // (set as an attribute on the underlying <select>) so we don't double-init
        // after Livewire morphs / page navigates. We also defensively strip
        // the `ts-hidden-accessible` helper class from the wrapper because
        // Tom Select v2 copies the original element's full class attribute onto
        // its wrapper at setup time — and if the original <select> was already
        // tagged as hidden-accessible from a prior life (e.g. before Livewire
        // restored the DOM), the wrapper inherits a 1px clipped layout.
        root.querySelectorAll('select.tom-select:not([data-ts-ready])').forEach(function (el) {
            // Strip leftover Tom Select state classes from the underlying <select>
            // before initialising so the wrapper does not inherit them.
            el.classList.remove('tomselected', 'ts-hidden-accessible');
            var ts = new TomSelect(el, {
                create: false,
                allowEmptyOption: true,
                plugins: el.multiple ? ['remove_button'] : [],
            });
            el.setAttribute('data-ts-ready', '1');
            if (ts.wrapper) {
                ts.wrapper.classList.remove('ts-hidden-accessible', 'tomselected');
            }
        });
    };

    // Generic delete confirm using SweetAlert2 — used by <button data-confirm-delete data-action="...">.
    window.AMS.confirmDelete = function (opts) {
        return Swal.fire({
            title: opts.title || window.AMS.i18n.confirm_delete_title,
            text:  opts.text  || window.AMS.i18n.confirm_delete_text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: window.AMS.i18n.yes_delete,
            cancelButtonText:  window.AMS.i18n.cancel,
            reverseButtons: true,
        });
    };

    document.addEventListener('DOMContentLoaded', function () {
        window.AMS.initPlugins(document);

        // Catch any delete <form> with .js-delete-form
        document.body.addEventListener('submit', function (e) {
            var form = e.target.closest('form.js-delete-form');
            if (!form || form.dataset.confirmed === '1') return;
            e.preventDefault();
            window.AMS.confirmDelete({
                title: form.dataset.confirmTitle,
                text:  form.dataset.confirmText,
            }).then(function (res) {
                if (res.isConfirmed) {
                    form.dataset.confirmed = '1';
                    form.submit();
                }
            });
        });

        // Catch any link with .js-confirm-delete (used by DataTables)
        document.body.addEventListener('click', function (e) {
            var link = e.target.closest('.js-confirm-delete');
            if (!link) return;
            e.preventDefault();
            window.AMS.confirmDelete({}).then(function (res) {
                if (res.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = link.dataset.action || link.getAttribute('href');
                    form.innerHTML =
                        '<input type="hidden" name="_token" value="' + (document.querySelector('meta[name="csrf-token"]')?.content || '') + '">' +
                        '<input type="hidden" name="_method" value="DELETE">';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });

    // Re-init plugins after every Livewire DOM update
    document.addEventListener('livewire:navigated', function () { window.AMS.initPlugins(document); });
    document.addEventListener('livewire:initialized', function () {
        if (!window.Livewire) return;
        Livewire.hook('morph.updated', function ({ el }) { window.AMS.initPlugins(el); });

        // Locale switch — swap the page without a hard refresh using Livewire navigate.
        Livewire.on('locale-changed', function () {
            if (typeof Livewire.navigate === 'function') {
                Livewire.navigate(window.location.href);
            } else {
                window.location.reload();
            }
        });
    });
</script>

@livewireScripts
@flasher_render
@stack('scripts')
