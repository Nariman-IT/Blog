import { createRouter, createWebHistory } from "vue-router"
import LoginView from "@/views/auth/LoginView.vue"
import RegisterView from "@/views/auth/RegisterView.vue"

const routes = [
  // { path: "/", name: "Home", component: Home },
  { path: "/register", name: "login", component: RegisterView },
  { path: "/login", name: "register", component: LoginView },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router