<template>
  <q-header elevated>
    <q-toolbar>
      <q-btn
        flat
        dense
        round
        icon="menu"
        aria-label="Menu"
        @click="toggleLeftDrawer"
      />

      <q-toolbar-title>
        Expenses Fly
      </q-toolbar-title>

      <q-space />

      <q-btn color="white" round>
        <q-icon color="primary" size="md" name="account_circle" />

        <q-menu
          transition-show="jump-down"
          transition-hide="jump-up"
        >
          <q-list style="min-width: 160px">
            <q-item clickable>
              <q-item-section @click="goToProfile">
                Profile
              </q-item-section>
            </q-item>

            <q-separator />

            <q-item clickable>
              <q-item-section @click="logout">
                Logout
              </q-item-section>
            </q-item>
          </q-list>
        </q-menu>
      </q-btn>
    </q-toolbar>
  </q-header>

  <q-drawer
    v-model="leftDrawerOpen"
    bordered
  >
    <sidebar-menu />
  </q-drawer>
</template>

<script lang="ts" setup>
  import { ref } from 'vue';
  import SidebarMenu from './SidebarMenu.vue';
  import { useAuth } from 'src/composables/useAuth';
  import { useRouter } from 'vue-router';

  const { fetchLogout } = useAuth();
  const router = useRouter();

  const leftDrawerOpen = ref(false);

  const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value;
  };

  const goToProfile = () => {
    router.push('/profile');
  };

  const logout = () => {
    fetchLogout()
      .then(() => {
        localStorage.removeItem('api-client-token');
        router.push('/login');
      })
      .catch();
  };
</script>
