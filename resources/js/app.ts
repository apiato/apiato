import type {DefineComponent} from 'vue';
import {createApp, h} from 'vue';
import {createInertiaApp, Head, Link} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import vuetify from './plugins/vuetify';
import '../styles/sass/app.scss';
import './auguments';

async function resolve(name: string): Promise<DefineComponent> {
    const matched = /(.*)@(.*)::/.exec(name);
    if (!matched) {
        throw new Error(`Invalid page name [${name}]`);
    }

    const section: string = matched[1].camelToPascalCase();
    const container: string = matched[2].camelToPascalCase();
    const pageName = name.replace(matched[0], '').camelToPascalCase();

    const pages: Record<string, Promise<DefineComponent>> = import.meta.glob('/app/Containers/**/**/UI/WEB/Pages/**/*.vue', {eager: true});
    const path = `/app/Containers/${section}/${container}/UI/WEB/Pages/${pageName}.vue`;

    return resolvePageComponent(path, pages);
}

createInertiaApp({
    resolve,
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(vuetify)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            .mount(el);
    },
});


