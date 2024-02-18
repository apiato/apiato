import Laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';
import Vuetify from 'vite-plugin-vuetify'
import ViteFonts from 'unplugin-fonts/vite'
import Checker from 'vite-plugin-checker'
import Components from 'unplugin-vue-components/vite'
import AutoImport from 'unplugin-auto-import/vite'
import { defineConfig } from 'vite';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        strictPort: true,
        hmr: {
            host: 'localhost',
        }
    },
    resolve: {
        alias: {
            // The Laravel plugin will re-write asset URLs to point to the Laravel
            // @ Points to ./src
            //'@': fileURLToPath(new URL('./src', import.meta.url)),
        },
        extensions: [
            '.ts',
            '.vue',
            '.js',
            '.json',
        ],
    },
    plugins: [
        Laravel({
            input: [
                'resources/js/app.ts',
            ],
            refresh: true,
        }),
        Vue({
            template: {
                transformAssetUrls: {
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,

                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
        Vuetify({
            autoImport: true,
            styles: { configFile: 'resources/styles/sass/settings.scss' },
        }),
        ViteFonts({
            google: {
                families: [{
                    name: 'Roboto',
                    styles: 'wght@100;300;400;500;700;900',
                }],
            },
        }),
        Checker({
            typescript: true,
            vueTsc: true,
            eslint: {
                lintCommand: 'eslint "./resources/js/*.{ts,tsx}"',
            },
        }),
        Components({
            dirs: ['app/Containers/**/**/UI/WEB/Pages/'],
            extensions: ['vue'],
            deep: true,
            dts: './resources/js/cache/components.d.ts',
            directoryAsNamespace: true,
            collapseSamePrefixes: true,
            directives: true,
            allowOverrides: false,
            include: [/\.vue$/, /\.vue\?vue/],
            exclude: [/[\\/]node_modules[\\/]/, /[\\/]\.git[\\/]/, /[\\/]\.nuxt[\\/]/],
            types: [],
        }),
        AutoImport({
            // targets to transform
            include: [
                /\.[tj]sx?$/, // .ts, .tsx, .js, .jsx
                /\.vue$/,
                /\.vue\?vue/, // .vue
                /\.md$/, // .md
            ],

            // global imports to register
            imports: [
                'vue',
            ],

            // Array of strings of regexes that contains imports meant to be filtered out.
            ignore: [],

            // Enable auto import by filename for default module exports under directories
            defaultExportByFilename: false,

            // Filepath to generate corresponding .d.ts file.
            // Defaults to './auto-imports.d.ts' when `typescript` is installed locally.
            // Set `false` to disable.
            dts: './resources/js/cache/auto-imports.d.ts',

            // Array of strings of regexes that contains imports meant to be ignored during
            // the declaration file generation. You may find this useful when you need to provide
            // a custom signature for a function.
            ignoreDts: [
                'ignoredFunction',
                /^ignore_/
            ],

            vueTemplate: true,

            // Inject the imports at the end of other imports
            injectAtEnd: true,

            // Generate corresponding .eslintrc-auto-import.json file.
            // eslint globals Docs - https://eslint.org/docs/user-guide/configuring/language-options#specifying-globals
            eslintrc: {
                enabled: true, // Default `false`
                filepath: './.eslintrc-auto-import.json', // Default `./.eslintrc-auto-import.json`
                globalsPropValue: true, // Default `true`, (true | false | 'readonly' | 'readable' | 'writable' | 'writeable')
            },
        })
    ],
});
