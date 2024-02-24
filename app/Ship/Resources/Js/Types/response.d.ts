import type { BasePageProps } from '@ship/Js/Types/shared-props';

interface Meta {
    include: string[];
    custom: unknown;
}

interface SingleResponse<TContract> extends BasePageProps {
    data: TContract;
    meta: Meta;
}

interface Pagination {
    total: number;
    count: number;
    per_page: number;
    current_page: number;
    total_pages: number;
    links: {
        next: string;
        previous: string;
    };
}

interface MetaWithPagination extends Meta {
    pagination: Pagination;
}

interface Instantiable<T> extends T {
    create: (data: T) => this;
}

export interface PaginatedResponse<TContract> extends /* @vue-ignore */ BasePageProps {
    data: TContract[];
    meta: MetaWithPagination;
}
