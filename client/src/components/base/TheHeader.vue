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

  <q-dialog v-model="isVerificationAccountVisible" seamless position="top">
    <q-card>
      <q-card-section class="row items-center no-wrap">
        <div class="text-weight-bold">Your email has not yet been verified, please enter your email and access the link sent to confirm your account!</div>

        <q-space />

        <q-btn flat label="Resend" @click="resendVerificationLink" />

        <q-space />

        <q-btn flat round icon="close" v-close-popup />
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script lang="ts" setup>
  import { useAuth } from 'src/composables/useAuth';
  import { useNotify } from 'src/composables/useNotify';
  import { useVerificationAccount } from 'src/composables/useVerificationAccount';
  import { useProfileStore } from 'src/stores/profile';
  import { onMounted, ref } from 'vue';
  import { useRouter } from 'vue-router';
  import SidebarMenu from './SidebarMenu.vue';

  const router = useRouter();
  const store = useProfileStore();

  const { fetchLogout } = useAuth();
  const { fetchResendVerificationLink } = useVerificationAccount();
  const { successNotify, errorNotify } = useNotify();

  const leftDrawerOpen = ref(false);
  const isVerificationAccountVisible = ref(false);

  onMounted(() => {
    isVerificationAccountVisible.value = !store.profileDetails.verified;
  });

  const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value;
  };

  const goToProfile = () => {
    router.push('/profile');
  };

  const resendVerificationLink = () => {
    fetchResendVerificationLink()
      .then((response) => {
        successNotify(response?.data?.message);

        router.push('/');
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      });
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
