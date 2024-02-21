import { Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { App, DefineComponent } from 'vue';

export function registerComponents(app: App) {
    app.component('InertiaHead', Head);
    app.component('InertiaLink', Link);
}

// https://neoighodaro.com/posts/6-reorganising-inertia-js-pages
// https://github.com/inertiajs/inertia-laravel/issues/247
// https://github.com/inertiajs/inertia/issues/188#issuecomment-675091658_
// https://github.com/inertiajs/inertia-laravel/issues/92
export async function resolveComponent(name: string): Promise<DefineComponent> {
    // https://stackoverflow.com/questions/2140627/how-to-do-case-insensitive-string-comparison
    // https://stackoverflow.com/questions/22187832/how-do-i-do-case-insensitive-comparisons-in-javascript
    // https://stackoverflow.com/questions/20742049/how-to-perform-a-case-insensitive-string-comparison
    const containerPage = /(.*)@(.*)::/.exec(name);
    const shipPage = /(ship)::/.exec(name);
    if (!containerPage && !shipPage) {
        throw new Error(`Invalid page name [${name}]`);
    }

    let path = '';
    if (containerPage) {
        if (containerPage.length !== 3 || containerPage[1] === undefined || containerPage[2] === undefined) {
            throw new Error(`Invalid page name [${name}]`);
        }
        const section = containerPage[1].camelToPascalCase();
        const container = containerPage[2].camelToPascalCase();
        const pageName = name.replace(containerPage[0], '').camelToPascalCase();
        path = `/app/Containers/${section}/${container}/UI/WEB/Pages/${pageName}.vue`;
    }
    if (shipPage) {
        if (shipPage.length !== 2 || shipPage[1] === undefined) {
            throw new Error(`Invalid page name [${name}]`);
        }
        const pageName = name.replace(shipPage[0], '').camelToPascalCase();
        path = `/app/Ship/Resources/Vue/Pages/${pageName}.vue`;
    }

    const pages = import.meta.glob<Promise<DefineComponent>>(['/app/Containers/**/**/UI/WEB/Pages/**/*.vue', '/app/Ship/Resources/Vue/**/*.vue'], { eager: true });
    const defaultLayout = await resolvePageComponent('/app/Ship/Resources/Vue/Layouts/DashboardLayout.vue', pages);
    const page = await resolvePageComponent(path, pages);
    if (page.default.layout === undefined) {
        page.default.layout = defaultLayout.default;
    }

    return page;
}
