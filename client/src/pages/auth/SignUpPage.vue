<template>
  <q-page class="row flex-center bg-grey-2" padding>
    <q-card class="col-12 col-sm-6 col-lg-4 q-pa-md shadow-2 my_card" bordered>
      <q-card-section class="text-center">
        <div class="text-grey-9 text-h5 text-weight-bold">Sign up</div>
      </q-card-section>

      <q-card-section>
        <q-input dense outlined v-model="form.email" type="email" label="Email"/>

        <q-input dense outlined class="q-mt-md" v-model="form.password" type="password" label="Password"/>

        <q-input dense outlined class="q-mt-md" v-model="form.first_name" label="First Name"/>

        <q-input dense outlined class="q-mt-md" v-model="form.last_name" label="Last Name"/>
      </q-card-section>

      <q-card-section>
        <q-btn color="dark" rounded size="md" label="Sign up" no-caps class="full-width" :loading="isLoading" @click="submitForm"/>
      </q-card-section>

      <q-card-section class="text-center q-pt-none">
        <div class="text-grey-8">
          Have an account yet?

          <router-link class="text-dark text-weight-bold" to="/login">
            Login.
          </router-link>
        </div>
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

  const { fetchSignUp } = useAuth();
  const router = useRouter();

  const { successNotify, errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);
  const form = ref<Auth.SignUp>({
    email: '',
    password: '',
    first_name: '',
    last_name: '',
  });

  const submitForm = () => {
    isLoading.value = true;

    fetchSignUp(form.value)
      .then(({ data }) => {
        successNotify('New account successfully registered!');

        localStorage.setItem('api-client-token', data.data.token);

        router.push('/');
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
      .finally(() => {
        isLoading.value = false;
      });
  };
</script>
