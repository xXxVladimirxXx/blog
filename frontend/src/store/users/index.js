import axios from '@/plugins/axios'

export default {
    namespaced: true,
    state: {
        users: [],
        user: {}
    },
    actions: {
        getAll({ commit }, params) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/users", method: "GET", params: params })
                    .then(resp => {
                        resolve(resp.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        getById({ commit }, user_id) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/users/" + user_id, method: "GET" })
                    .then(resp => {
                        commit("setUser", resp.data.data)
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        create({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/users", data: user, method: "POST" })
                    .then(resp => {
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        edit({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/users/" + user.id, data: user, method: "PUT" })
                    .then(resp => {
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        delete({ commit }, user_id) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/users/" + user_id, method: "DELETE" })
                    .then(resp => {
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
    },
    mutations: {
        setAll(state, users) {
            state.users = users
        },
        setUser(state, user) {
            state.user = user
        }
    },
    getters: {
        all(state) {
            return state.users
        },
        getUser(state) {
            return state.user
        }
    }
};
