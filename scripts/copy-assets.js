#!/usr/bin/env node
// Copies vendor assets from node_modules to public/assets/backend
// to satisfy the references in resources/views/admin/layouts/admin_partials/*.blade.php
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname  = path.dirname(__filename);
const root       = path.resolve(__dirname, '..');
const dest       = path.join(root, 'public/assets/backend/assets');

const copies = [
    // Bootstrap CSS/JS
    ['node_modules/bootstrap/dist/css/bootstrap.min.css', 'css/bootstrap.min.css'],
    ['node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'css/bootstrap.min.css.map'],
    ['node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'js/bootstrap.bundle.min.js'],
    ['node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map', 'js/bootstrap.bundle.min.js.map'],
    // jQuery
    ['node_modules/jquery/dist/jquery.min.js', 'js/jquery.min.js'],
    // Simplebar
    ['node_modules/simplebar/dist/simplebar.min.css', 'plugins/simplebar/css/simplebar.css'],
    ['node_modules/simplebar/dist/simplebar.min.js', 'plugins/simplebar/js/simplebar.min.js'],
    // Metismenu
    ['node_modules/metismenu/dist/metisMenu.min.css', 'plugins/metismenu/css/metisMenu.min.css'],
    ['node_modules/metismenu/dist/metisMenu.min.js', 'plugins/metismenu/js/metisMenu.min.js'],
    // Perfect Scrollbar
    ['node_modules/perfect-scrollbar/css/perfect-scrollbar.css', 'plugins/perfect-scrollbar/css/perfect-scrollbar.css'],
    ['node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js', 'plugins/perfect-scrollbar/js/perfect-scrollbar.js'],
    // SweetAlert2
    ['node_modules/sweetalert2/dist/sweetalert2.min.css', 'plugins/sweetalert2/sweetalert2.min.css'],
    ['node_modules/sweetalert2/dist/sweetalert2.all.min.js', 'plugins/sweetalert2/sweetalert2.all.min.js'],
    // flatpickr
    ['node_modules/flatpickr/dist/flatpickr.min.css', 'plugins/flatpickr/flatpickr.min.css'],
    ['node_modules/flatpickr/dist/flatpickr.min.js', 'plugins/flatpickr/flatpickr.min.js'],
    // Tom Select
    ['node_modules/tom-select/dist/css/tom-select.bootstrap5.min.css', 'plugins/tom-select/tom-select.bootstrap5.min.css'],
    ['node_modules/tom-select/dist/js/tom-select.complete.min.js', 'plugins/tom-select/tom-select.complete.min.js'],
    // DataTables
    ['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'plugins/datatables/dataTables.bootstrap5.min.css'],
    ['node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js', 'plugins/datatables/dataTables.bootstrap5.min.js'],
    ['node_modules/datatables.net/js/dataTables.min.js', 'plugins/datatables/dataTables.min.js'],
    // Alpine.js
    ['node_modules/alpinejs/dist/cdn.min.js', 'js/alpine.min.js'],
];

function copyBootstrapIcons() {
    const src = path.join(root, 'node_modules/bootstrap-icons');
    if (!fs.existsSync(src)) {
        console.warn('skip bootstrap-icons (not installed)');
        return;
    }
    const targetCss = path.join(dest, 'plugins/bootstrap-icons/font/bootstrap-icons.css');
    const targetFontDir = path.join(dest, 'plugins/bootstrap-icons/font/fonts');
    fs.mkdirSync(path.dirname(targetCss), { recursive: true });
    fs.mkdirSync(targetFontDir, { recursive: true });
    fs.copyFileSync(path.join(src, 'font/bootstrap-icons.css'), targetCss);
    for (const f of fs.readdirSync(path.join(src, 'font/fonts'))) {
        fs.copyFileSync(path.join(src, 'font/fonts', f), path.join(targetFontDir, f));
    }
}

for (const [from, to] of copies) {
    const src = path.join(root, from);
    const tgt = path.join(dest, to);
    if (!fs.existsSync(src)) {
        console.warn(`skip ${from} (not found)`);
        continue;
    }
    fs.mkdirSync(path.dirname(tgt), { recursive: true });
    fs.copyFileSync(src, tgt);
}

copyBootstrapIcons();

console.log('Assets copied to public/assets/backend/assets');
