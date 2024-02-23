import { AxiosInstance } from 'axios';
import { route as routeFn } from 'ziggy-js';
import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { SharedPageProps } from '../../../../../resources/js/types';

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    const route: typeof routeFn;
}

declare module 'vue' {
    interface ComponentCustomProperties {
        route: typeof routeFn;
    }
}

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, SharedPageProps {}
}
