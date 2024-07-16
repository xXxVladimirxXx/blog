import axios from '@/plugins/axios';

export default {
    namespaced: true,
    state: {
        currentUser: undefined !== localStorage.getItem('userData') ? JSON.parse(localStorage.getItem('userData')) : null
    },
    actions: {
        initCSRF() {
            return new Promise(function(resolve, reject) {
                axios.get('/sanctum/csrf-cookie')
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },
        login(store, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/login", data: user, method: "POST" })
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
            });
        },
        register(store, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/register", data: user, method: "POST" })
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
            });
        },
        getMe(store) {
            return new Promise((resolve, reject) => {
                axios({ url: "/api/current-user", method: "GET" })
                    .then(response => {
                        store.commit('setUser', response.data.data)
                        resolve(response.data)
                    }, err => {
                        reject(err.response)
                    })
            });
        },
        logout() {
            axios({ url: "/api/logout", method: "GET" })
            localStorage.removeItem("userData")
        }
    },
    mutations: {
        setUser(state, user) {
            state.currentUser = user
            localStorage.removeItem("userData")
            localStorage.setItem('userData', JSON.stringify(user))
        },
        updateUserParam (state, payload) {
            state.currentUser[payload.key] = payload.value
            localStorage.removeItem("userData")
            localStorage.setItem('userData', JSON.stringify(state.currentUser))
        }
    },
    getters: {
        user(state) {
            return state.currentUser
        },
        authenticated(state) {
            return !!state.currentUser
        }
    }
};
