<template>
    <div>
        <Header />

        <v-container class="main-container h-100">
            <router-view></router-view>
        </v-container>

        <Footer />
    </div>
</template>
  
<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

export default {
    components: {Header, Footer},
    name: 'Main',
}
</script>

<style scoped>
.main-container {
    padding-top: 70px;
}
</style>