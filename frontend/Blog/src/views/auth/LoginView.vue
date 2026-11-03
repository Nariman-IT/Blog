<script setup lang="ts">
import { ref } from "vue"
import { useRouter } from "vue-router"
import { type LoginPayload } from "@/types"
import { authService, TokenService } from "@/services"
import LoginForm from "@/components/auth/LoginForm.vue"

const loading = ref(false)
const router = useRouter()
const serverError = ref<string | null>(null)

if (TokenService.isAuthorized()) {
  router?.push({ name: 'home' })
}

async function handleLoginSubmit(payload: LoginPayload ) {
  loading.value = true

  try {
    await authService.login(payload)
    router?.push({ path: '/' })
  } catch(e) {
    serverError.value = e instanceof Error ? e.message : "Неизвестная ошибка!"
  } finally {
    loading.value = false
  }
}
</script>

<template>
<h1>Войти</h1>
<login-form 
    @submit="handleLoginSubmit" 
    :loading 
  />
</template>