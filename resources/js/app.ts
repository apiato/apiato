import '../styles/sass/app.scss';
import '@/utility/auguments';
import type { App } from 'vue';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { componentResolver } from '@/utility';
import { registerPlugins } from '@/plugins';
import { registerComponents } from '@/components';

createInertiaApp({
    resolve: componentResolver,
    setup({ el, App, props, plugin }) {
        const app: App = createApp({ render: () => h(App, props) });
        app.use(plugin);
        registerPlugins(app);
        registerComponents(app);
        app.mount(el);
    },
});
