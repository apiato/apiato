import { Model } from '@ship/Js/Parents/model.ts';

export abstract class User extends Model {
    protected constructor(
        public object: string,
        public id: string,
        public name: string,
        public email: string,
    ) {
        super();
    }

    abstract firstName(): string;
}
