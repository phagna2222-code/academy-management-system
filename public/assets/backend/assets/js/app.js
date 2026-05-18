/* app.js - admin UI helpers (sidebar toggle, theme switcher, back-to-top) */
(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState !== 'loading') return fn();
        document.addEventListener('DOMContentLoaded', fn);
    }

    ready(function () {
        const wrapper = document.querySelector('.wrapper');
        if (!wrapper) return;

        // Sidebar toggle (desktop)
        const desktopToggle = document.querySelector('.toggle-icon');
        if (desktopToggle) {
            desktopToggle.addEventListener('click', () => wrapper.classList.toggle('toggled'));
        }
        // Sidebar toggle (mobile)
        const mobileToggle = document.querySelector('.mobile-toggle-icon');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                wrapper.classList.toggle('show-sidebar');
                wrapper.classList.toggle('show-overlay');
            });
        }
        const overlay = document.querySelector('.overlay');
        if (overlay) {
            overlay.addEventListener('click', () => {
                wrapper.classList.remove('show-sidebar');
                wrapper.classList.remove('show-overlay');
            });
        }

        // Metismenu init (jQuery + metisMenu loaded earlier)
        if (window.jQuery && jQuery.fn.metisMenu) {
            jQuery('#menu').metisMenu();
        }

        // Simplebar init
        if (window.SimpleBar) {
            document.querySelectorAll('[data-simplebar]').forEach((el) => {
                if (!el._simplebar) {
                    el._simplebar = new SimpleBar(el);
                }
            });
        }

        // Back to top
        const backToTop = document.querySelector('.back-to-top');
        if (backToTop) {
            backToTop.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            window.addEventListener('scroll', () => {
                if (window.scrollY > 200) backToTop.classList.add('show');
                else backToTop.classList.remove('show');
            });
        }

        // Theme variation switcher
        const html = document.documentElement;
        const themeMap = {
            LightTheme:     ['light-theme'],
            DarkTheme:      ['dark-theme'],
            SemiDarkTheme:  ['semi-dark'],
            MinimalTheme:   ['minimal-theme'],
        };
        Object.keys(themeMap).forEach((id) => {
            const input = document.getElementById(id);
            if (!input) return;
            input.addEventListener('change', () => {
                Object.values(themeMap).flat().forEach((c) => html.classList.remove(c));
                themeMap[id].forEach((c) => html.classList.add(c));
                try { localStorage.setItem('ams_theme', themeMap[id].join(',')); } catch (e) {}
            });
        });
        try {
            const saved = localStorage.getItem('ams_theme');
            if (saved) {
                saved.split(',').forEach((c) => html.classList.add(c));
            }
        } catch (e) {}
    });
})();
