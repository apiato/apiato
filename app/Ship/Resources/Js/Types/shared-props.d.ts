export interface AuthUser {
    id: number;
    name: string;
    email: string;
}

export type SharedPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: AuthUser;
    };
};
