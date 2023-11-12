<template>
  <q-list>
    <q-item
      v-for="(menuItem, index) in sidebarMenuItems"
      :key="index"
      :to="menuItem.path"
      exact
    >
      <q-item-section
        v-if="menuItem.icon"
        avatar
      >
        <q-icon :name="menuItem.icon" />

        </q-item-section>

        <q-item-section>
          <q-item-label>{{ menuItem.title }}</q-item-label>
      </q-item-section>
    </q-item>
  </q-list>
</template>

<script lang="ts" setup>
  const sidebarMenuItems = [
    {
      title: 'Home',
      icon: 'house',
      path: '/'
    },
    {
      title: 'Expenses',
      icon: 'calculate',
      path: '/expenses'
    }
  ];
</script>
