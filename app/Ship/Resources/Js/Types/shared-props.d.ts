interface AuthUser {
    id: number;
    name: string;
    email: string;
}

interface SharedPageProps {
    shared: {
        auth: {
            user: AuthUser;
        };
        query: {
            [key: string]: string;
            search?: string;
        };
    };
}

export type BasePageProps = SharedPageProps & Record<string, unknown>;
