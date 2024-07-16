import { createApp } from 'vue'
import { createStore } from 'vuex'
import '@/style.css'

import App from '@/App.vue'
import vuetify from '@/plugins/vuetify'
import modules from '@/store'
import router from '@/router'

export const store = createStore({
    ...modules
})

const app = createApp(App)

app.use(vuetify)
app.use(router)
app.use(store)

app.config.globalProperties.$loader = (loader) => {
    return store.commit('general/setLoader', loader)
}

app.mount('#app')
