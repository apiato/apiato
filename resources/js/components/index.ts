import { Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { App, DefineComponent } from 'vue';

export function registerComponents(app: App) {
    app.component('InertiaHead', Head);
    app.component('InertiaLink', Link);
}

export async function resolveComponent(name: string): Promise<DefineComponent> {
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

    const pages: Record<string, Promise<DefineComponent>> = import.meta.glob<Promise<DefineComponent>>(['/app/Containers/**/**/UI/WEB/Pages/**/*.vue', '/app/Ship/Resources/Vue/Pages/**/*.vue'], { eager: true });

    return resolvePageComponent(path, pages);
}
