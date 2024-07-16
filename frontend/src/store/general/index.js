export default {
    namespaced: true,
    state: {
        loader: false
    },
    mutations: {
        setLoader(state, loader) {
            state.loader = loader
        }
    },
    getters: {
        loader(state) {
            return state.loader
        }
    }
}
