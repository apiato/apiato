interface Dto {
    object: string;
    id: string;
    [key: string]: unknown;
}

interface Meta {
    include: string[];
    custom: unknown;
}

interface SingleResponse {
    data: Dto;
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

export interface PaginatedResponse {
    data: Dto[];
    meta: MetaWithPagination;
}
