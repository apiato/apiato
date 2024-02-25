interface AuthUser {
    id: number;
    name: string;
    email: string;
}

export interface ApiatoQueryString {
    [key: string]: string | number | undefined;
    search?: string;
    page?: number;
    limit?: number;
    orderBy?: string;
    sortedBy?: string;
    filter?: string;
}

interface SharedPageProps {
    shared: {
        auth: {
            user: AuthUser;
        };
        query: ApiatoQueryString;
    };
}

export type BasePageProps = SharedPageProps & Record<string, unknown>;
