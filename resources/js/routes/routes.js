import BackendLayout from '../backend/BackendLayout.vue';
import AuthLayout from '../backend/AuthLayout.vue';
import Master from '../backend/Master.vue';


function resourceUrl(resource, title) {
    return [{
            path: "list",
            name: resource + ".index",
            // component: require(`../backend/${resource}/Index`).default,
            component: () =>
                import (
                    `../backend/${resource}/Index`
                ),
            meta: {
                page_title: title + "List ",
            },
        },
        {
            path: "create",
            name: resource + ".create",
            component: () =>
                import (
                    `../backend/${resource}/Create`
                ),
            meta: {
                page_title: `Add a New ${resource}`,
            },
        },
        {
            path: "edit/:id",
            name: resource + ".edit",
            component: require(`../backend/${resource}/Create`).default,
            meta: {
                page_title: `Edit ${resource}`,
            },
        },
    ];
}

export default ({
    mode: 'history',
    routes: [{
            path: '/backend',
            redirect: '/backend/dashboard',
            component: BackendLayout,
            meta: { requiresAuth: true },
            children: [{
                    path: 'dashboard',
                    name: 'dashboard',
                    meta: { page_title: "Welcome to Dashboard" },
                    component: require('../backend/Dashboard.vue').default
                },
                {
                    path: 'setting',
                    name: 'setting',
                    meta: { page_title: "Setting" },
                    component: require('../backend/Setting.vue').default
                },
                {
                    path: 'profile',
                    name: 'profile',
                    meta: { page_title: "Profile" },
                    component: require('../backend/auth/Profile.vue').default
                },
                {
                    path: "admin",
                    component: Master,
                    children: resourceUrl("admin", "Admins"),
                },
                {
                    path: "category",
                    component: Master,
                    children: resourceUrl("category", "Categories"),
                },
                {
                    path: "partner",
                    component: Master,
                    children: resourceUrl("partner", "Partners"),
                },
                {
                    path: "quiz",
                    component: Master,
                    children: resourceUrl("quiz", "Quizs"),
                },
                {
                    path: "prediction",
                    component: Master,
                    children: resourceUrl("prediction", "Predictions"),
                },
                {
                    path: 'register',
                    name: 'register',
                    meta: { page_title: "Register a User" },
                    component: require('../backend/auth/Register.vue').default
                },
            ]
        },
        {
            path: '/backend',
            component: AuthLayout,
            children: [{
                    path: 'login',
                    name: 'login',
                    meta: { guest: true, page_title: "Login" },
                    component: require('../backend/auth/Login.vue').default
                },

            ]
        },
        { path: '/backend/*', name: 'page not found', component: require('../backend/NotFound.vue').default }
    ],
    linkActiveClass: 'active',
    linkExactActiveClass: "active", // active class for *exact* links.
    fallback: true,

})