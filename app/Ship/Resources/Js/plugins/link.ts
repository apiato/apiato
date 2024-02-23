import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import type { App } from 'vue';

// https://github.com/vuetifyjs/vuetify/issues/11573#issuecomment-1465046711
export default {
    install(app: App) {
        app.component('RouterLink', {
            useLink(props: { to: string }) {
                const href = props.to;
                const currentUrl = computed(() => usePage().url);
                return {
                    route: computed(() => ({ href })),
                    isActive: computed(() => currentUrl.value.startsWith(href)),
                    isExactActive: computed(() => href === currentUrl.value),
                    navigate(e: KeyboardEvent) {
                        if (e.shiftKey || e.metaKey || e.ctrlKey) return;
                        e.preventDefault();
                        router.visit(href);
                    },
                };
            },
        });
    },
};
