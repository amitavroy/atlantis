import Vue from 'vue';
import Vuex from 'vuex';

import DocumentStore from './modules/Document/documentStore';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
  modules: {
    DocumentStore
  },
  strict: debug
});
