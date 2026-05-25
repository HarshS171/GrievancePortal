import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.initTheme = () => {
    const saved = localStorage.getItem('site-theme');
    const preferred = saved || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    document.documentElement.classList.toggle('dark', preferred === 'dark');
    localStorage.setItem('site-theme', preferred);
};

window.toggleTheme = () => {
    const isDark = !document.documentElement.classList.contains('dark');
    document.documentElement.classList.toggle('dark', isDark);
    localStorage.setItem('site-theme', isDark ? 'dark' : 'light');
};

window.showPageLoader = () => {
    const loader = document.getElementById('page-loader');
    if (loader) {
        loader.classList.remove('opacity-0', 'scale-x-0');
        loader.classList.add('scale-x-100');
    }
};

window.addEventListener('DOMContentLoaded', () => {
    window.initTheme();
});

window.addEventListener('beforeunload', () => {
    window.showPageLoader();
});

Alpine.start();
