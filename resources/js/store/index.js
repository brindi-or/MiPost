import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        isAuthenticated: false,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
            state.isAuthenticated = !!user;
        },
    },
    actions: {
        async login({ commit }, credentials) {
            await axios.get('/sanctum/csrf-cookie');
            const response = await axios.post('api/login', credentials);
            commit('SET_USER', response.data.user);
        },
        async logout({ commit }) {
            await axios.post('/logout');
            commit('SET_USER', null);
        },
        async getUser({ commit }) {
            try {
                const response = await axios.get('/api/user');
                commit('SET_USER', response.data);
            } catch (error) {
                commit('SET_USER', null);
            }
        },
        async register({ commit }, userData) {
        await axios.get('/sanctum/csrf-cookie');
        const response = await axios.post('/register', userData);
        commit('SET_USER', response.data.user);
    },
    },
});
