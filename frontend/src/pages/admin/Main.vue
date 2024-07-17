<template>
    <v-container>
        <h1>Admin panel</h1>

        <router-link to="/admin/posts">Posts</router-link><br>
        <router-link to="/admin/users">Users</router-link>

        <router-view></router-view>
    </v-container>
</template>
  
<script>
export default {
    name: 'Main',
}
</script>
