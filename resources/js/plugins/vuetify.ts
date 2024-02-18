import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import { defaultLight } from '../themes/default-light.ts';
import { defaultDark } from '../themes/default-dark.ts';
import { md2 } from 'vuetify/blueprints';
import '@mdi/font/css/materialdesignicons.css';

export default createVuetify({
  blueprint: md2,
  theme: {
    defaultTheme: 'defaultDark',
    themes: {
      defaultDark,
      defaultLight,
    },
  },
  icons: {
    defaultSet: 'mdi',
  },
});