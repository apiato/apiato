import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import './bootstrap';
import './extensions.js';
import '../css/app.css';

createInertiaApp({
    resolve,
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .mount(el)
    },
});

async function resolve(name)
{
    const matched = /(.*)@(.*)::/.exec(name);
    const section = matched[1].camelToPascalCase();
    const container = matched[2].camelToPascalCase();
    const pageName = name.replace(matched[0], "").camelToPascalCase();

    if (null === matched) {
        return `./Pages/${name}.vue`;
    }

    const pages = import.meta.glob('/app/Containers/**/**/UI/WEB/Pages/**/*.vue', { eager: true })
    const path = `/app/Containers/${section}/${container}/UI/WEB/Pages/${pageName}.vue`;

    return resolvePageComponent(path, pages);
}
