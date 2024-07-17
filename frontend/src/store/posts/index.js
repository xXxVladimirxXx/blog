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
                        commit("setPosts", resp.data.data.data)
                        resolve(resp.data)
                    })
                    .catch(err => reject(err.response)) 
            });
        },
        getById({ commit }, post_id) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/posts/" + post_id, method: "GET" })
                    .then(resp => {
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
        setPosts(state, posts) {
            state.posts = posts
        }
    },
    getters: {
        getPosts(state) {
            return state.posts
        }
    }
};
