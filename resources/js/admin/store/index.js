import Vue from "vue";
import Vuex from "vuex";

import * as auth from "@/admin/store/modules/Auth";
import * as user from "@/admin/store/modules/User";
import * as app from "@/admin/store/modules/App";

Vue.use(Vuex);

export default new Vuex.Store({
  strict: true,

  modules: {
    auth,
    user,
    app
  },
});
