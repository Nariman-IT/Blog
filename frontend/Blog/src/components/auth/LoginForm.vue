<script setup lang="ts">
import { ref, useTemplateRef } from "vue";
import { type LoginPayload } from "@/types"

const props = defineProps<{
  loading: boolean,
}>()

const isValid = ref(false)
const formRef = useTemplateRef("formRef")

const form = ref<LoginPayload>({
  email: "",
  password: "",
});

const emit = defineEmits<{
  submit: [payload: LoginPayload],
}>()

const rules = {
  email: [
    (value: string) => {
      if (value) return true;
      return "Поле обязательно";
    },

    (value: string) => {
      if (/.+@.+\..+/.test(value)) return true;
      return "E-mail некорректен";
    },
  ],

  password: [
    (value: string) => {
      if (value) return true;
      return "Поле обязательно";
    },

    (value: string) => {
      if (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/.test(value)) return true;
      return "Пароль должен содержать латинские буквы и цифры.";
    },
  ],
};

function onSubmit() {
  formRef.value?.validate()
  if (!isValid.value) return;
  emit("submit", { ...form.value })
}
</script>

<template>
  <v-sheet width="300">
    <v-form 
      v-model="isValid"
      ref="formRef"
      @submit.prevent 
    >
      <v-text-field 
        v-model="form.email" 
        label="E-mail"
        :rules="rules.email"
      />
      <v-text-field 
        v-model="form.password" 
        label="Пароль"
        type="password"
        :rules="rules.password"
      />
      <v-btn 
        :loading
        @click="onSubmit"
        block
      >Войти</v-btn>
    </v-form>
  </v-sheet>
</template>
