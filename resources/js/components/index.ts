import type { App } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

export function registerComponents(app: App) {
    app.component('InertiaHead', Head);
    app.component('InertiaLink', Link);
}
