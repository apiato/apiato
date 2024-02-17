import type { App } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';

export function registerComponents(app: App) {
    app.component('InertiaHead', Head);
    app.component('InertiaLink', Link);
}

export async function resolveComponent(name: string): Promise<DefineComponent> {
    const matched = /(.*)@(.*)::/.exec(name);
    if (
        !matched ||
        matched.length < 3 ||
        matched[1] === undefined ||
        matched[2] === undefined
    ) {
        throw new Error(`Invalid page name [${name}]`);
    }

    const section: string = matched[1].camelToPascalCase();
    const container: string = matched[2].camelToPascalCase();
    const pageName = name.replace(matched[0], '').camelToPascalCase();

    const pages: Record<string, Promise<DefineComponent>> = import.meta.glob(
        '/app/Containers/**/**/UI/WEB/Pages/**/*.vue',
        { eager: true },
    );
    const path = `/app/Containers/${section}/${container}/UI/WEB/Pages/${pageName}.vue`;

    return resolvePageComponent(path, pages);
}
