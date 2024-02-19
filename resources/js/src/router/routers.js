import { createRouter, createWebHistory } from "vue-router";
import Layout from "../component/Layout.vue";
import AuthLayout from "../component/AuthLayout.vue";
import Login from "../views/auth/Login.vue";
import Dashboard from "../views/dashboard/Dashboard.vue";
import Users from "../views/Users/Users.vue";
import Store from "../store";
import store from "../store";

const routes = [
  {
    path: "/",
    redirect: "/dashboard",
    name: "Dashboard",
    component: Layout,
    meta: {
      requiresAuth: true,
    },
    children: [
      {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
      },
      {
        path: "/users",
        name: "Users",
        component: Users,
      },
    ],
  },
  {
    path: "/auth",
    redirect: "/auth/login",
    name: "auth",
    component: AuthLayout,
    children: [
      {
        path: "/auth/login",
        name: "Login",
        component: Login,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory("/"),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !Store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.name === "Login") {
    next({ name: "Dashboard" });
  } else {
    next();
  }
});

export default router;
