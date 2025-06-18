import 'vuetify/styles';
import { createVuetify, type ThemeDefinition } from 'vuetify';
import * as VuetifyComponents from 'vuetify/components';
import { fr } from 'vuetify/locale'

const ElPolloTheme: ThemeDefinition = {
  colors: {
    primary: '#FDFFFC',
    secondary: '#0D1B1E',
    info: '#058E3F',
    success: '#069E2D',
    warning: '#F1A208',
  },
};

const vuetify = createVuetify({
  locale: {
    locale: 'fr',
    messages: { fr },
  },
  theme: {
    defaultTheme: 'ElPolloTheme',
    themes: {
      ElPolloTheme,
    },
  },
  components: {
    ...VuetifyComponents,
  },
});

export default vuetify;
