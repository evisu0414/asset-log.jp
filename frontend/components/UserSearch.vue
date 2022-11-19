<template>
  <div>
    <button @click="get">ユーザー検索</button>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>氏名</th>
          <th>メールアドレス</th>
          <th>所属会社</th>
          <th>ロール</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <template v-if="user.funeralCompany">
              ID{{ user.funeralCompany.id }}:{{ user.funeralCompany.name }}
            </template>
            <template v-else>無所属</template>
          </td>
          <td>{{ user.authorityType.description }}</td>
          <td>
            <button @click="deleteUser(user.id)">削除</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
const nuxtApp = useNuxtApp();
const users = ref();

function get() {
  users.value = null;
  nuxtApp.$axios
    .$get('/api/users')
    .then((response) => {
      users.value = response.data;
    })
    .catch((error) => {
      console.log(error);
    });
}

function deleteUser(id) {
  nuxtApp.$axios.$delete('/api/users/' + id).then(() => {
    get();
  });
}
</script>
