<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <q-page class="flex flex-center bg-grey-2">
        <q-card class="q-pa-md shadow-2 my_card" bordered>
          <q-card-section class="text-center">
            <div class="text-grey-9 text-h5 text-weight-bold">Sign in</div>

            <div class="text-grey-8">Sign in below to access your account</div>
          </q-card-section>

          <q-card-section>
            <q-input dense outlined v-model="email" label="Email Address"/>

            <q-input dense outlined class="q-mt-md" v-model="password" type="password" label="Password"/>
          </q-card-section>

          <q-card-section>
            <q-btn color="dark" rounded size="md" label="Sign in" no-caps class="full-width" @click=""/>
          </q-card-section>

          <q-card-section class="text-center q-pt-none">
            <div class="text-grey-8">
              Don't have an account yet?

              <router-link class="text-dark text-weight-bold" to="/sign-up">
                Sign up.
              </router-link>
            </div>
          </q-card-section>
        </q-card>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script lang="ts" setup>
  import { ref } from 'vue';

  const email = ref<string>('');
  const password = ref<string>('');
</script>
