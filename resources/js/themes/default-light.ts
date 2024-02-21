import { type ThemeDefinition } from 'vuetify';
import colors from 'vuetify/util/colors';

export const defaultLight: ThemeDefinition = {
    dark: false,
    colors: {
        primary: colors.blue.darken2,
        secondary: colors.grey.darken1,
        accent: colors.shades.black,
        error: colors.red.accent3,
        info: colors.teal.lighten1,
        success: colors.green.accent3,
        warning: colors.amber.base,
    },
};
