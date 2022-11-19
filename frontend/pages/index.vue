<template>
  <div>
    <h1>トップページ</h1>
    <NuxtLink to="/user">ユーザー</NuxtLink>
    <button @click="logout">logout</button>
  </div>
</template>

<script setup>
const nuxtApp = useNuxtApp();

async function logout() {
  await nuxtApp.$auth.logout();
}
</script>
