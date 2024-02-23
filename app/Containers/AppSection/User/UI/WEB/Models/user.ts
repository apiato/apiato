import { User as ParentUser } from '@ship/Js/Parents/user.ts';

export class User extends ParentUser {
    constructor(
        public override object: string,
        public override id: string,
        public override name: string,
        public override email: string,
        public gender: string,
        public birth: string,
    ) {
        super(object, id, name, email);
    }

    public from(): this {
        return this;
    }

    public firstName(): string {
        return 'sag';
    }
}
