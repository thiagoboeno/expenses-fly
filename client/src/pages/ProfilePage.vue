<template>
  <q-page class="row flex-center" padding>
    <q-card class="col-12 col-sm-6 col-lg-4 q-pa-md shadow-2 my_card" bordered>
      <q-card-section>
        <q-input dense outlined v-model="form.first_name" label="Fisrt Name"/>

        <q-input dense outlined class="q-mt-md" v-model="form.last_name" label="Last Name"/>

        <q-input dense outlined class="q-mt-md" v-model="form.birth_date" type="date" label="Value"/>

        <q-input dense outlined class="q-mt-md" v-model="form.phone_number" label="Phone" mask="+55 (##) #####-####"/>
      </q-card-section>

      <q-card-section>
        <q-btn color="dark" rounded size="md" label="Submit" no-caps class="full-width" :loading="isLoading" @click="submitForm"/>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script lang="ts" setup>
  import { ref, onMounted } from 'vue';
  import { useProfile } from 'src/composables/useProfile';
  import { Profile } from 'src/types/Profile';
  import { useProfileStore } from 'src/stores/profile';
  import { useNotify } from 'src/composables/useNotify';
  import { formatDate } from 'src/utils/date';

  const store = useProfileStore();
  const { fetchProfile, updateProfile } = useProfile();

  const { successNotify, errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);
  const form = ref<Profile.CreationDTO>({
    first_name: '',
    last_name: '',
    birth_date: '',
    phone_number: '',
  });

  onMounted(() => {
    fetchProfile()
      .then(({ data }) => {
        store.updateProfile(data.data);
        form.value = store.profileDetails;
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
  });

  const submitForm = () => {
    isLoading.value = false;

    updateProfile({
      ...form.value,
      birth_date: formatDate(form.value.birth_date),
    })
      .then(({ data }) => {
        store.updateProfile(data.data);

        successNotify('Profile datails updated!');
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
      .finally(() => {
        isLoading.value = false;
      });
  };
</script>
