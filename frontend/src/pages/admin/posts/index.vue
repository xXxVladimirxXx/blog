<template>

  <v-card class="mt-5">
    <v-card-text>
      <v-row>
        <v-col cols="3" class="d-flex align-center">
          <span class="mr-1">
              Show
          </span>
          <v-select
            density="compact"
            class="mr-1"
            outlined
            v-model="perPage"
            :items="[5, 10, 25, 50, 100]"
          />
          <span>
              entries
          </span>
        </v-col>
      </v-row>

      <!--  USERS TABLE  -->
      <VRow>
        <VCol>
          <VTable>
            <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(post, index) in items" :key="index">
              <td>{{ post.id }}</td>
              <td>{{ post.title }}</td>
              <td>{{ post.content }}</td>
              <td>
                  <span title="Edit post" class="cursor-pointer mr-2">
                    <router-link :to="`/post/${post.id}`">
                      <v-icon icon="mdi-pencil" />
                    </router-link>
                  </span>
                  <!-- <span title="Delete" class="cursor-pointer mr-2">
                    <v-icon color="error" icon="mdi-delete" />
                  </span> -->
              </td>
            </tr>
            </tbody>
          </VTable>
        </VCol>
      </VRow>

      <!--    PAGINATION    -->
      <VRow>
        <VCol>Total: {{ total }} entries</VCol>
        <VCol></VCol>
        <VCol>
          <VPagination
            v-if="pagesCount > 1"
            @update:modelValue="getPosts"
            v-model="page"
            :length="pagesCount"
          />
        </VCol>
      </VRow>
    </v-card-text>
  </v-card>
</template>


<script>
export default {
name: 'posts-index',
data: () => ({
  perPage: 10,
  page: 1,
  pagesCount: 0,
  total: 0,
  items: []
}),
mounted () {
  this.getPosts()
},
watch: {
  perPage: {
    handler () {
      this.getPosts()
    }
  }
},
methods: {
  getPosts (page = this.page) {
    this.$loader(true)
    this.$store.dispatch('posts/getAll', { perPage: this.perPage, page: page })
      .then((response) => {
        this.items      = response.data.data
        this.pagesCount = response.data.last_page
        this.total      = response.data.total
        this.$loader(false)
      })
      .catch(() => this.$loader(false))
  },
  delete () {
    this.$loader(true)
    this.$store.dispatch('posts/delete', this.activeItem.id)
      .then(() => this.getPosts())
      .catch(() => this.$loader(false))
  }
}
}
</script>
