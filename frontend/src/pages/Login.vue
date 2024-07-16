<template>
  <v-container class="d-flex justify-center align-center w-100 h-100">
    <v-card class="pa-4" min-width="400">
      <v-card-title>Login</v-card-title>
      <v-card-text>
        <v-form @submit="login">
          <v-text-field
            v-model="user.email"
            label="Email"
            type="email"
            required
          ></v-text-field>
          <v-text-field
            v-model="user.password"
            label="Password"
            type="password"
            required
          ></v-text-field>

          <v-alert
              v-model="showErrorMessage"
              type="error"
              closable
              class="mt-5"
              variant="tonal"
              :title="textError"
            />
          
          <v-col
            cols="12"
            class="text-center"
          >
            <v-btn type="submit" color="primary" class="mt-4">Login</v-btn>
          </v-col>
        </v-form>


        <v-col
          cols="12"
          class="text-center"
        >
          <span>New on our platform?</span>
          <router-link
            class="text-primary ms-2"
            to="/register"
          >Create an account
          </router-link>
        </v-col>
      </v-card-text>
    </v-card>
  </v-container>
</template>


<script>
export default {
  data() {
    return {
      user: {
        email: '',
        password: '',
      },
      showErrorMessage: false,
      textError: ''
    }
  },
  mounted () {
    this.$store.dispatch('auth/initCSRF')
  },
  methods: {
    login (event) {
      event.preventDefault()
      this.$loader(true)

      this.$store.dispatch('auth/login', this.user)
        .then((res) => {
          this.$loader(false)

          const userData = res.data.user

          // Save the user data to local storage and vuex store
          this.$store.commit('auth/setUser', userData)

          this.$router.push('/')
        })
        .catch(error => {
          this.$loader(false)
          
          const { response } = error
          this.showErrorMessage = true
          this.textError = response.data.message
        })
    }
  }
}
</script>
