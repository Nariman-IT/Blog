<script setup lang="ts">
import RegisterForm from '@/components/auth/RegisterForm.vue';
import type { RegisterPayload } from '@/types';
import { authService } from '@/services';
import { ref } from 'vue';
import { useRouter } from 'vuetify/lib/composables/router.mjs';

const loading = ref(false)
const router = useRouter()
const serverError = ref<string | null>(null)

async function handleRegisterSubmit(payload: RegisterPayload ) {
  loading.value = true

  try {
    await authService.register(payload)
  } catch(e) {
    serverError.value = e instanceof Error ? e.message : "Неизвестная ошибка!"
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <v-alert v-if="serverError" type="error">
    {{ serverError }}
  </v-alert>

  <h1>Регистрация</h1>

  <register-form 
    @submit="handleRegisterSubmit" 
    :loading 
  />
</template>
