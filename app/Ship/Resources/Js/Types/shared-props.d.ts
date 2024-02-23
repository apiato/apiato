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
    };
}

export type BasePageProps = SharedPageProps & Record<string, unknown>;
