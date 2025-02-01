<script setup lang="ts">
  const data = ref(null);

  definePageMeta({
    middleware: 'auth'
  });

  const cookie = useCookie('my_auth_token');

  async function fetch() {
    const result = await $fetch('http://localhost:8000/api/user', {
        headers: {
            // @ts-ignore
            Authorization: `Bearer ${cookie.value.token}`
        }
    });
    // @ts-ignore
    data.value = result;
  }
</script>

<template>
  <Navbar />
  <div>
    <h1>Welcome to Home Page</h1>
    <button @click="fetch">Fetch</button>
      <div v-if="data">
        {{ data }}
      </div>
  </div>
</template>
