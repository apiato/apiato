// String extensions
Object.defineProperty(String.prototype, 'camelToPascalCase', {
    value() {
        return this.split('/')
            .map(part => part.charAt(0).toUpperCase() + part.slice(1))
            .join('/');
    }
});
