import { createRouter, createWebHistory } from "vue-router";
import Layout from "../component/Layout.vue";
import Login from "../views/auth/Login.vue";
import Dashboard from "../views/dashboard/Dashboard.vue";
import Users from "../views/Users/Users.vue";

const router = createRouter({
  history: createWebHistory("/"),
  routes: [
    {
      path: "/",
      redirect: "/dashboard",
      name: "Dashboard",
      component: Layout,
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
      path: "/auth/login",
      name: "login",
      component: Login,
    },
  ],
});

export default router;
