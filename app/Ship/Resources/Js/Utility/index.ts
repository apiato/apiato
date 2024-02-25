import '@ship/Js/Utility/auguments.ts';

export function debounce<F extends (...args: any[]) => any>(callback: F, delay = 300) {
    let timeoutId: ReturnType<typeof setTimeout>;
    return function (this: any, ...args: Parameters<F>) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => callback.apply(this, args), delay);
    };
}
