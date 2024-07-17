<template>
    <div>
        <h1>Posts</h1>

        <v-container>
            <div v-for="post in posts">
                <v-card class="mx-auto mb-5">
                    <v-card-text>
                        <p class="text-h5">{{ post.title }}</p>

                        <v-divider class="mt-3 mb-3"></v-divider>
                        <div class="text-medium-emphasis">
                            {{ post.content }}
                        </div>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-space-between">
                        <v-btn
                            color="green-lighten-2"
                            text="View"
                            @click="$router.push(`/post/${post.id}`)"
                        ></v-btn>
                        <v-btn
                            v-if="user && user.role.name == 'superAdmin'"
                            color="orange-lighten-2"
                            text="Edit"
                            @click="$router.push(`admin/post/${post.id}`)"
                        ></v-btn>
                    </v-card-actions>
                </v-card>
            </div>
        </v-container>
    </div>
</template>
  
<script>
export default {
    name: 'Posts',
    created() {
        this.$loader(true)

        this.getPosts()
            .then(() => this.$loader(false))
    },
    computed: {
        posts() {
            return this.$store.getters['posts/getPosts'];
        },
        user() {
            return this.$store.getters['auth/user'];
        },
    },
    methods: {
        getPosts() {
            return this.$store.dispatch('posts/getAll', {perPage: 5})
                .then((res) => {})
        }
    }
}
</script>
