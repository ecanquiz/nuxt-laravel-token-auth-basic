<script setup lang="ts">
  const name = ref("John Doe");
  const email = ref("user@email.ext");
  const password = ref("password");
  const confirm_password = ref("password");
  const errors = ref([])
  const cookie = useCookie('my_auth_token');

  async function signup() {
    try{
      const result = await $fetch('http://localhost:8000/api/signup', {
        method: 'POST',
        body: {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: confirm_password.value
        }
      })
      // cookie.value = result as unknown as 'string | null | undefined';
      // @ts-ignore
      cookie.value = result;
      navigateTo('/');
      // console.log(cookie.value);
    } catch(e) {
        // @ts-ignore
        console.log(e)
        // @ts-ignore
        console.log(e.data)
        // @ts-ignore
        console.log(e.data.errors)
        // @ts-ignore
        errors.value = e.data.errors;
    }
  } 
</script>

<template>
    <Navbar />
    <button @click="signup">Signup</button>
    <ul v-if="errors">
      <li v-for="error in errors" style="color: red">
        {{ error }}
      </li>
    </ul>
</template>