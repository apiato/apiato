import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import light from '../themes/custom-light';
import { md3 } from 'vuetify/blueprints';
import '@mdi/font/css/materialdesignicons.css';

export default createVuetify({
    blueprint: md3,
    theme: {
        defaultTheme: 'light',
        themes: {
            light,
        },
    },
    icons: {
        defaultSet: 'mdi',
    },
});
