import type { App } from 'vue';
import vuetify from './vuetify.ts';
// https://github.com/tighten/ziggy/discussions/565
import { ZiggyVue } from 'ziggy-js';
import link from '@ship/Js/Plugins/link.ts';

export function registerPlugins(app: App) {
    app.use(vuetify);
    app.use(ZiggyVue);
    app.use(link);
}
