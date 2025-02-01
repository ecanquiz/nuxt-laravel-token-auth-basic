<script setup lang="ts">
  const email = ref("user@email.ext");
  const password = ref("password");
  const cookie = useCookie('my_auth_token');
  const isAuth = ref(false);

  definePageMeta({
    middleware: 'guest'
  });

  watchEffect(() => {
    if (cookie.value) {
        isAuth.value = true;
    } else {
        isAuth.value = false;
    }
  });

  async function login() {
    const result = await $fetch('http://localhost:8000/api/login', {
        method: 'POST',
        body: {
            email: email.value,
            password: password.value
        }
    })
    // cookie.value = result as unknown as 'string | null | undefined';
    // @ts-ignore
    cookie.value = result;
    navigateTo('/');
    // console.log(cookie.value);
  }
</script>

<template>
    <Navbar />
    <div v-if="!isAuth">
      <button @click="login">Login</button>
    </div>  
</template>