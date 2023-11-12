<template>
  <q-page class="row flex-center" padding>
    <q-card class="col-12 col-sm-6 col-lg-4 q-pa-md shadow-2 my_card" bordered>
      <q-card-section>
        <div class="text-overline text-orange-9">Expense</div>
        <div class="text-h5 q-mt-sm q-mb-xs">
          {{ expense.user }}
        </div>
        <div class="text-caption text-grey">
          {{ expense.description }}
        </div>
      </q-card-section>

      <q-card-actions align="center">
        <q-btn flat color="primary" label="Back" to="/expenses" />
        <q-btn flat color="yellow-5" label="Edit" :to="`/expenses/${expenseId}`" />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script lang="ts" setup>
  import { ref, computed, onMounted } from 'vue';
  import { useExpenses } from 'src/composables/useExpenses';
  import { Expenses } from 'src/types/Expenses';
  import { useRoute } from 'vue-router';
  import { useNotify } from 'src/composables/useNotify';

  const route = useRoute();

  const { getExpense } = useExpenses();

  const { errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);
  const expense = ref<Partial<Expenses.ListItem>>({});

  const expenseId = computed<number>(() => Number(route.params.id));

  onMounted(() => {
    isLoading.value = true;

    getExpense(expenseId.value)
      .then(({ data }) => {
        expense.value = data.data;
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
      .finally(() => {
        isLoading.value = false;
      });
  });
</script>
