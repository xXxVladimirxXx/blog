import Main from '../../pages/Main.vue';
import Posts from '../../pages/Posts.vue';
import AdminMain from '../../pages/admin/Main.vue';
import PostsAdmin from '../../pages/admin/posts/index.vue';
import PostEdit from '../../pages/admin/posts/edit.vue';
import UsersAdmin from '../../pages/admin/users/index.vue';

import Login from '../../pages/Login.vue';
import Register from '../../pages/Register.vue';

export const routes = [
    { 
        path: '/',
        name: 'index',
        component: Main,
        children: [
            {
                path: '',
                component: Posts,
            },
            {
                path: 'admin',
                component: AdminMain,
                name: 'AdminMain',
                meta: {
                    requiresAuth: true,
                    role: 'superAdmin'
                },
                children: [
                    {
                        path: 'posts',
                        component: PostsAdmin,
                        name: 'PostsAdmin',
                    },
                    {
                        path: 'post/:id',
                        name: 'editPost',
                        component: PostEdit,
                    },
                    {
                        path: 'users',
                        component: UsersAdmin,
                        name: 'UsersAdmin',
                    }
                ]
            }
        ],
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    }
];
