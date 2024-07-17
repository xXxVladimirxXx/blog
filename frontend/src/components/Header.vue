<template>
    <div>
        <v-toolbar dark app color="black" class="navigation pr-4">
            <v-toolbar-title>Blog</v-toolbar-title>

            <v-spacer></v-spacer>

            <router-link  to="/">
                Posts
            </router-link>

            <router-link v-if="user && user.name && user.role.name == 'superAdmin'" to="/admin">
                Admin panel
            </router-link>

            <v-divider vertical class="ml-3 mr-3"></v-divider>

            <div v-if="user && user.name">
                
                {{ user.name }}

                <v-icon icon="mdi-account-circle"></v-icon>
                
                <v-btn @click="logout" style="padding: 0;"><v-icon icon="mdi-logout"></v-icon></v-btn>
            </div>

            <router-link v-else to="/login">Login <v-icon icon="mdi-login"></v-icon></router-link>
            
        </v-toolbar>
    </div>
</template>

<script>
export default {
    name: 'Header',
    computed: {
        user() {
            return this.$store.getters['auth/user'];
        },
    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout')
        }
    }
}
</script>

<style scoped>
header {
    position: fixed;
    z-index: 999;
}
</style>