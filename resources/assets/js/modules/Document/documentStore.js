import _ from 'lodash';
import * as documentActions from './documentActions';

const state = {
  folders: [],
  navigation: []
}

const actions = documentActions.actions;

const mutations = {
  SET_DIRECTORIES(state, folderStructure) {
    state.folders = folderStructure;
  },
  SET_NAVIGATION(state, path) {
    state.navigation.push(path);
  },
  NAVIGATE_BACK(state) {
    state.navigation.pop();
  }
}

export default {
  state, mutations, actions
}
