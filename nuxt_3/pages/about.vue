<script setup lang="ts">
  definePageMeta({
    middleware: 'auth'
  });
</script>

<template>
  <Navbar />
  <div>
    <h1>About</h1>
  </div>
</template>