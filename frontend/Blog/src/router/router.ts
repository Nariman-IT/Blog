import { createRouter, createWebHistory } from "vue-router"
import LoginView from "@/views/auth/LoginView.vue"
import RegisterView from "@/views/auth/RegisterView.vue"
import HomeView from "@/views/home/HomeView.vue"
import { TokenService } from "@/services"

const routes = [
  { path: "/", name: "home", component: HomeView, meta: { requiresAuth: true } },
  { path: "/register", name: "register", component: RegisterView },
  { path: "/login", name: "login", component: LoginView },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !TokenService.isAuthorized()) {
    next({ name: 'login' })
  } else {
    next()
  }
})

export default router