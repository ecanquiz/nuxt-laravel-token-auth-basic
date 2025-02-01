<script setup lang="ts">
  const cookie = useCookie('my_auth_token');
  const isAuth = ref(false);

  watchEffect(() => {
    if (cookie.value) {
        isAuth.value = true;
    } else {
        isAuth.value = false;
    }
  });

  async function logout() {
    const result = await $fetch('http://localhost:8000/api/logout', {
        method: 'DELETE',
        headers: {
            // @ts-ignore
            Authorization: `Bearer ${cookie.value.token}`
        }
    });
    // console.log(result);
    cookie.value = null;
    navigateTo('/login');
  }
</script>

<template>
  <div>
    <div v-if="isAuth">
      <NuxtLink to="/" style="margin: 1em">Home</NuxtLink>
      <NuxtLink to="/about" style="margin: 1em">About</NuxtLink>
      <button  @click="logout" style="margin: 1em">Logout</button>
    </div>
    <div v-else>
        <NuxtLink to="/login" style="margin: 1em">Login</NuxtLink>
        <NuxtLink to="/signup" style="margin: 1em">Signup</NuxtLink>
    </div>
  </div>
</template>