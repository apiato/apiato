import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';

export async function componentResolver(
    name: string,
): Promise<DefineComponent> {
    const matched = /(.*)@(.*)::/.exec(name);
    if (!matched) {
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
