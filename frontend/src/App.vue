<template>
  <v-app theme="dark">
    <v-main>
      <v-overlay
        v-model="loader"
        scroll-strategy="reposition"
        class="align-center justify-center">
        <v-progress-circular
          color="primary"
          indeterminate
          size="64"
        />
      </v-overlay>

      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'App',
  computed: {
    loader () {
      return this.$store.getters['general/loader']
    }
  }
}
</script>