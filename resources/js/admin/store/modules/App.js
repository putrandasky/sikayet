export const namespaced = true;

export const state = {
  openSidebar: false,
  worksheet: {
    name: '',
    id: null
  }
};

export const mutations = {
  SET_SIDEBAR(state, n) {
    state.openSidebar = n;
  },
  SET_WORKSHEET(state, n) {
    state.worksheet.name = n.name;
    state.worksheet.id = n.id;
  },

};

export const actions = {};

export const getters = {

};
