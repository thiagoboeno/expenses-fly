<template>
  <q-layout view="lHh Lpr lFf">
    <the-header />

    <q-page-container class="bg-grey-2">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup lang="ts">
  import TheHeader from 'components/base/TheHeader.vue';
</script>
