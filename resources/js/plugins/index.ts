import type { App } from 'vue';
import vuetify from './vuetify';
import { ZiggyVue } from '../../../vendor/tightenco/ziggy/dist/vue.m';

export function registerPlugins(app: App) {
    app.use(vuetify);
    app.use(ZiggyVue);
}
