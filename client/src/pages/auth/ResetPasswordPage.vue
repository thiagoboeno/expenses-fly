<template>
  <q-page class="row flex-center" padding>
    <q-card class="col-12 col-sm-6 col-lg-4 q-pa-md shadow-2 my_card" bordered>
      <q-card-section class="text-center">
        <div class="text-grey-9 text-h5 text-weight-bold">Forgot Password</div>
      </q-card-section>

      <q-card-section>
        <q-input dense outlined v-model="form.email" type="email" label="Email"/>

        <q-input dense outlined class="q-mt-md" v-model="form.password" type="password" label="Password"/>

        <q-input dense outlined class="q-mt-md" v-model="form.confirmation_password" type="password" label="Confirm Password"/>
      </q-card-section>

      <q-card-section>
        <q-btn color="dark" rounded size="md" label="Confirm" no-caps class="full-width" :loading="isLoading" @click="submitForm"/>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script lang="ts" setup>
  import { ref, onMounted } from 'vue';
  import { useAuth } from 'src/composables/useAuth';
  import { Auth } from 'src/types/Auth';
  import { useRoute, useRouter } from 'vue-router';
  import { useNotify } from 'src/composables/useNotify';

  type AuthResetPasswordForm = Omit<Auth.ResetPassword, 'token'>;

  const route = useRoute();
  const router = useRouter();

  const { fetchResetPassword } = useAuth();

  const { successNotify, errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);
  const token = ref<string>('');
  const form = ref<AuthResetPasswordForm>({
    email: '',
    password: '',
    confirmation_password: '',
  });

  onMounted(() => {
    token.value = route.params.token?.toString();
  });

  const submitForm = () => {
    isLoading.value = true;

    fetchResetPassword({
      token: token.value,
      ...form.value,
    })
      .then(() => {
        successNotify('Password successfully changed!');

        router.push('/login');
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
      .finally(() => {
        isLoading.value = false;
      });
  };
</script>
