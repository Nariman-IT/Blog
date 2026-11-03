<script setup lang="ts">
  import { computed, onMounted, ref } from 'vue'
import { useRouter } from "vue-router"
  import { postService } from '@/services'
  import { TokenService } from '@/services';
  import type { Post } from '@/types';

  const router = useRouter()

  const posts = ref<Post[]>([])
  const isLoading = ref(false)
  const nextCursor = ref<string>()
  
  const hasNext = computed(() => !!nextCursor.value)

  function logout() {
    TokenService.clear()
    router.push({ name: "login" })
  }

  async function loadPosts() {
    try {
      isLoading.value = true
      const response = await postService.getPosts({cursor: nextCursor.value})
      console.log(response)
      posts.value.push(...response.posts.data)
      nextCursor.value = response.posts.meta.next_cursor
      console.log("nextCursor = ", nextCursor.value)
    } 
    // catch(e) {
    //   alert("Не удалось загрузить данные!")
    // } 
    finally {
      isLoading.value = false
    }
  }

  onMounted(async () => {
    await loadPosts()
  })
</script>

<template>
  <v-container>
    <h1 class="text-h3 mb-6">Главная</h1>
    <v-btn
      @click="logout"
      v-if="TokenService.isAuthorized()"
    >Выйти</v-btn>
    <v-row>
      <v-col 
        v-for="post in posts" 
        :key="post.id" 
        cols="12"
      >
        <v-card class="pa-4" variant="outlined">
          <v-card-title>{{ post.title }}</v-card-title>
          <v-card-text>{{ post.excerpt }}</v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <div v-if="isLoading && posts.length === 0" class="d-flex justify-center my-4">
      <v-progress-circular indeterminate color="primary" />
    </div>

    <v-btn
      type="button"
      @click="loadPosts"
      v-if="hasNext"
      block
    >Загрузить ещё</v-btn>
  </v-container>
</template>