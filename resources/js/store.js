import { isLoggedIn, logOut } from "./shared/utils/auth";

export default {
    state: {
        lastSearch: {
            teacher_id: null,
        },
        isLoggedIn: false,
        SuccessMessage: '',
        user: {}
    },
    mutations: {
        setLastSearch(state, payload) {
         state.lastSearch = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setLoggedIn(state, payload) {
            state.isLoggedIn = payload;
        },
        setSuccessMessage(state, payload) {
          state.SuccessMessage = payload;
        },

    },
    actions: {

      setLastSearch(context, payload) {
           context.commit('setLastSearch', payload);
           localStorage.setItem('lastSearch', JSON.stringify(payload));
       },

        loadStoredState(context) {
           context.commit("setLoggedIn", isLoggedIn());
       },

        async loadUser({ commit, dispatch }) {
            if (isLoggedIn()) {
                try {
                    const user = (await axios.get("user")).data;
                    commit("setUser", user);
                    commit("setLoggedIn", true);
                } catch (error) {
                    dispatch("logout");
                }
            }
        },
        logout({ commit }) {
            commit("setUser", {});
            commit("setLoggedIn", false);
            logOut();
        }
    },
};
