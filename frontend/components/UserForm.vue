<template>
  <div>
    <div>{{ message }}</div>
    <form @submit.prevent="store">
      <div>
        <label>ID(IDを指定すると更新になります)</label>
        <input v-model="id" />
      </div>
      <div>
        <label>氏名</label>
        <input v-model="name" />
      </div>
      <div>
        <label>メールアドレス</label>
        <input v-model="email" />
      </div>
      <div v-if="!id">
        <label>パスワード</label>
        <input v-model="password" />
      </div>
      <div v-if="!id">
        <label>パスワード確認</label>
        <input v-model="passwordConfirmation" />
      </div>
      <button type="submit">送信</button>
    </form>
  </div>
</template>

<script setup>
const nuxtApp = useNuxtApp();
const message = ref();
const id = ref();
const name = ref();
const email = ref();
const password = ref();
const passwordConfirmation = ref();

function store() {
  message.value = '';
  id.value ? update() : create();
}

function create() {
  nuxtApp.$axios
    .post('/api/users', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value,
    })
    .then(() => {
      message.value = '登録完了';
    })
    .catch((error) => {
      message.value = 'エラー発生';
      console.log(error);
    });
}

function update() {
  nuxtApp.$axios
    .put('/api/users/' + id.value, {
      name: name.value,
      email: email.value,
    })
    .then(() => {
      message.value = '更新完了';
    })
    .catch((error) => {
      message.value = 'エラー発生';
      console.log(error);
    });
}

function get(id) {
  return nuxtApp.$axios.get('/api/users/' + id).then((response) => {
    return response;
  });
}

watch(id, () => {
  get(id.value).then((response) => {
    name.value = response.data.data.name;
    email.value = response.data.data.email;
  });
});
</script>
