<script setup lang="ts">
import { ref, useTemplateRef } from "vue";
import { type RegisterPayload } from "@/types"

const props = defineProps<{
  loading: boolean,
}>()

const isValid = ref(false)
const formRef = useTemplateRef("formRef")

const form = ref<RegisterPayload>({
  name: "",
  email: "",
  password: "",
  passwordConfirmation: "",
});

const emit = defineEmits<{
  submit: [payload: RegisterPayload],
}>()

const rules = {
  name: [
    (value: string) => {
      if (value) return true;
      return "Поле обязательно";
    },

    (value: string) => {
      if (value?.length >= 2) return true;

      return "Имя слишком короткое";
    },
  ],

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

  passwordConfirmation: [
    (value: string) => !!value || "Подтвердите пароль.",
    (value: string) => value === form.value.password || "Пароли не совпадают.",
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
        v-model="form.name" 
        label="Имя пользователя" 
        :rules="rules.name"
      />
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
      <v-text-field 
        v-model="form.passwordConfirmation" 
        label="Подтверждение пароля"
        type="password"
        :rules="rules.passwordConfirmation"
      />
      <v-btn 
        :loading
        @click="onSubmit"
        block
      >Войти</v-btn>
    </v-form>
  </v-sheet>
</template>
