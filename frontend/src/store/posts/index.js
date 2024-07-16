import axios from '@/plugins/axios'

export default {
    namespaced: true,
    state: {
        posts: [],
    },
    actions: {
        getAll({ commit }, params) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/posts", method: "GET", params: params })
                    .then(resp => {
                        resolve(resp.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        getById({ commit }, user_id) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/posts/" + user_id, method: "GET" })
                    .then(resp => {
                        commit("setUser", resp.data.data)
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        create({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/posts", data: user, method: "POST" })
                    .then(resp => {
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        edit({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/posts/" + user.id, data: user, method: "PUT" })
                    .then(resp => {
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        delete({ commit }, user_id) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/posts/" + user_id, method: "DELETE" })
                    .then(resp => {
                        resolve(resp.data.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
    },
    mutations: {
        setAll(state, posts) {
            state.posts = posts
        }
    },
    getters: {
        all(state) {
            return state.posts
        }
    }
};
