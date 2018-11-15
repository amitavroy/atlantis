import axios from 'axios';
import docStore from './documentStore';
import LocalDB from './../../utils/LocalDB';

export const actions = {
  getFolderStructure: ({commit}, path) => {
    commit('SET_NAVIGATION', path);
    return axios.post('/api/document/list', {path: path}).then(response => {
      commit('SET_DIRECTORIES', response.data);
      LocalDB.setData('lastPath', path);
      return response
    });
  },
  handleFolderBack: ({commit}, path) => {
    const length = docStore.state.navigation.length;

    if (length < 2) {
      return true;
    }

    const folder = docStore.state.navigation[length - 2];

    commit('NAVIGATE_BACK');
    window.eventBus.$emit('directory_loading');
    return axios.post('/api/document/list', {path: folder}).then(response => {
      commit('SET_DIRECTORIES', response.data);
      window.eventBus.$emit('directory_loaded');
      return response
    });
  },
  handleFileDelete: ({commit}, postData) => {
    return axios.post('/api/document/delete', postData).then(response => {
      commit('SET_DIRECTORIES', response.data);
      window.eventBus.$emit('directory_loaded');
      return response;
    });
  }
};
