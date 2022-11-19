<template>
  <div>
    <h3>ログイン中のユーザー</h3>
    <template v-if="activeUser">
      <div>
        ID:{{ activeUser.id }} {{ activeUser.name }}({{ activeUser.email }})
      </div>
      <div>
        所属：{{
          activeUser.funeralCompany ? activeUser.funeralCompany.name : '無所属'
        }}({{ activeUser.authorityType.description }})
      </div>
    </template>
  </div>
</template>

<script setup>
const nuxtApp = useNuxtApp();
const activeUser = nuxtApp.$auth.user.data;
</script>
