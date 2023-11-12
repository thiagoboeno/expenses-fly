<template>
  <q-page class="row flex-center" padding>
    <q-card class="col-12 col-sm-6 col-lg-4 q-pa-md shadow-2 my_card" bordered>
      <q-card-section>
        <q-input dense outlined v-model="form.description" type="textarea" label="Description" :maxlength="191"/>

        <q-input dense outlined class="q-mt-md" v-model="form.value" label="Value" prefix="R$" mask="#.##"/>

        <q-input dense outlined class="q-mt-md" v-model="form.date" type="date" label="Date"/>
      </q-card-section>

      <q-card-section>
        <q-btn color="dark" rounded size="md" label="Submit" no-caps class="full-width" :loading="isLoading" @click="submitForm"/>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script lang="ts" setup>
  import { ref } from 'vue';
  import { useExpenses } from 'src/composables/useExpenses';
  import { Expenses } from 'src/types/Expenses';
  import { useRouter } from 'vue-router';
  import { useNotify } from 'src/composables/useNotify';
  import { formatDate } from 'src/utils/date';

  const router = useRouter();

  const { createExpense } = useExpenses();

  const { successNotify, errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);
  const form = ref<Expenses.CreationDTO>({
    description: '',
    value: 0.00,
    date: '',
  });

  const submitForm = () => {
    isLoading.value = false;

    createExpense({
      ...form.value,
      date: formatDate(form.value.date),
    })
      .then(() => {
        successNotify('Expense successfully created!');
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
      .finally(() => {
        isLoading.value = false;
        router.push('/expenses');
      });
  };
</script>
