export {};

// https://www.typescriptlang.org/docs/handbook/declaration-files/templates/global-modifying-module-d-ts.html
Object.defineProperty(String.prototype, 'camelToPascalCase', {
    value(): string {
        return this.split('/')
            .map((part: string) => part.charAt(0).toUpperCase() + part.slice(1))
            .join('/');
    },
});

declare global {
    interface String {
        camelToPascalCase(this: string): string;
    }
}
