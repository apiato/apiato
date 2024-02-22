import type { App } from 'vue';
import vuetify from './vuetify';
import { ZiggyVue } from '../../../vendor/tightenco/ziggy/dist/vue.m';
import link from '@/plugins/link.ts';

export function registerPlugins(app: App) {
    app.use(vuetify);
    app.use(ZiggyVue);
    app.use(link);
}
