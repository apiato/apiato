import { AxiosInstance } from 'axios';
import { route as routeFn } from 'ziggy-js';
import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { BasePageProps } from '@ship/Js/Types/shared-props';

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
    interface PageProps extends InertiaPageProps, BasePageProps {}
}
