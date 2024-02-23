export interface AuthUser {
    id: number;
    name: string;
    email: string;
}

export interface User extends AuthUser {
    created_at: string;
    updated_at: string;
}

export type SharedPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: AuthUser;
    };
};
