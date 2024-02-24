import { User as ParentUser } from '@ship/Js/Parents/user.ts';
import type { UserContract } from '@containers/AppSection/User/UI/WEB/Contracts/user.ts';

export class User extends ParentUser implements UserContract {
    public gender: string;
    public birth: string;

    private constructor(o: UserContract) {
        super(o.object, o.id, o.name, o.email);
        this.gender = o.gender;
        this.birth = o.birth;
    }

    private static create(o: UserContract): User;
    private static create(o: UserContract[]): User[];
    private static create(o: UserContract | UserContract[]): User | User[] {
        if (Array.isArray(o)) {
            return o.map((i) => new User(i));
        }
        return new User(o);
    }

    public static createOne(o: UserContract): User {
        return User.create(o);
    }

    public static createMany(o: UserContract[]): User[] {
        return User.create(o);
    }
}
