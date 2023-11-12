<template>
  <q-page class="row flex-center" padding>
    <q-card class="col-12 col-sm-6 col-lg-4 q-pa-md shadow-2 my_card" bordered>
      <q-card-section class="text-center">
        <div class="text-grey-9 text-h5 text-weight-bold">Forgot Password</div>
      </q-card-section>

      <q-card-section>
        <q-input dense outlined v-model="form.email" type="email" label="Email"/>
      </q-card-section>

      <q-card-section>
        <q-btn color="dark" rounded size="md" label="Confirm" no-caps class="full-width" :loading="isLoading" @click="submitForm"/>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script lang="ts" setup>
  import { ref } from 'vue';
  import { useAuth } from 'src/composables/useAuth';
  import { Auth } from 'src/types/Auth';
  import { useRouter } from 'vue-router';
  import { useNotify } from 'src/composables/useNotify';

  const { fetchForgotPassword } = useAuth();
  const router = useRouter();

  const { successNotify, errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);
  const form = ref<Auth.ForgotPassword>({
    email: '',
  });

  const submitForm = () => {
    isLoading.value = true;

    fetchForgotPassword(form.value)
      .then(() => {
        successNotify('Reset Password link has ben sended to your email!');

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
