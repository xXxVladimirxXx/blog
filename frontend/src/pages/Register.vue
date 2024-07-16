<template>
    <v-container class="d-flex justify-center align-center w-100 h-100">
      <v-card class="pa-4" min-width="400">
        <v-card-title>Register</v-card-title>
        <v-card-text>
          <v-form @submit="register">
            <v-text-field
              v-model="user.name"
              label="Name"
              type="text"
              required
            ></v-text-field>
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
              <v-btn type="submit" color="primary" class="mt-4">Register</v-btn>
            </v-col>
          </v-form>
  
  
          <v-col
            cols="12"
            class="text-center"
          >
            <span>Already have an account?</span>
            <router-link
              class="text-primary ms-2"
              to="/login"
            >Sign in instead
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
          name: '',
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
        register (event) {
            event.preventDefault()
            this.$store.dispatch('auth/register', this.user)
                .then((res) => {
                    const userData = res.data.user

                    // Save the user data to local storage and vuex store
                    this.$store.commit('auth/setUser', userData)
                    localStorage.setItem('userData', JSON.stringify(userData))

                    this.$router.push('/')
                })
                .catch(error => {
                    const { response } = error
                    this.showErrorMessage = true
                    this.textError = response.data.message
                })
        }
    }
  }
  </script>
  