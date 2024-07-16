import Main from '../../pages/Main.vue';
import Posts from '../../pages/Posts.vue';
import Login from '../../pages/Login.vue';
import Register from '../../pages/Register.vue';

export const routes = [
    { 
        path: '/',
        component: Main,
        children: [
            {
                path: '',
                component: Posts
            },
            // {
            //     path: 'admin',
            //     component: Admin,
            //     meta: {
            //         requiresAuth: true
            //     }
            // }
        ],
    },
    {
        path: '/login',
        component: Login,
    },
    {
        path: '/register',
        component: Register,
    }
];
