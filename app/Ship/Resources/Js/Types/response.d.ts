import type { Castable } from '@ship/Js/Types/castable';
import type { BasePageProps } from '@ship/Js/Types/shared-props';

interface Meta {
    include: string[];
    custom: unknown;
}

interface SingleResponse<TModel extends Castable> extends BasePageProps {
    data: TModel;
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

export interface PaginatedResponse<TModel extends Castable> extends /* @vue-ignore */ BasePageProps {
    data: TModel[];
    meta: MetaWithPagination;
}
