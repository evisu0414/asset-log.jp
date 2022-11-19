<template>
  <div>
    <h1>ログイン</h1>
    <form @submit.prevent="login">
      <input v-model="email" type="text" placeholder="メールアドレス" />
      <input v-model="password" type="password" placeholder="パスワード" />
      <button type="submit">ログイン</button>
    </form>
  </div>
</template>

<script setup>
const nuxtApp = useNuxtApp();
const email = ref();
const password = ref();

function login() {
  nuxtApp.$axios.get('/sanctum/csrf-cookie').then(() => {
    nuxtApp.$auth.loginWith('laravelSanctum', {
      data: {
        email: unref(email),
        password: unref(password),
      },
    });
  });
}
</script>
