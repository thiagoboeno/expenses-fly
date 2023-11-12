<template>
  <q-page class="row flex-center" padding>
    <q-table
      class="col-12 col-md-10"
      :rows="expenses"
      :columns="columns"
      row-key="user"
      :loading="isLoading"
    >
      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <q-btn icon="visibility" round flat color="primary" :to="`/expenses/${props.row.id}`">
            <q-tooltip>
              Show Expense
            </q-tooltip>
          </q-btn>

          <q-btn icon="mode_edit" round flat color="yellow-5" :to="`/expenses/${props.row.id}/edit`">
            <q-tooltip>
              Edit Expense
            </q-tooltip>
          </q-btn>

          <q-btn icon="delete" round flat color="red-5" @click="onClickDelete(props.row.id)">
            <q-tooltip>
              Delete Expense
            </q-tooltip>
          </q-btn>
        </q-td>
      </template>
    </q-table>

    <delete-expense-dialog v-model="showModal" :expense-id="selectedExpense" />
  </q-page>
</template>

<script lang="ts" setup>
  import { ref, onMounted } from 'vue';
  import { useExpenses } from 'src/composables/useExpenses';
  import DeleteExpenseDialog from 'components/expenses/DeleteExpenseDialog.vue';
  import { QTableProps } from 'quasar';
  import { Expenses } from 'src/types/Expenses';
import { useNotify } from 'src/composables/useNotify';

  const columns: QTableProps['columns'] = [
    { name: 'id', align: 'left', label: 'id', field: 'id', sortable: true },
    { name: 'user', align: 'center', label: 'User', field: 'user', sortable: true },
    { name: 'description', align: 'center', label: 'Description', field: 'description' },
    { name: 'value', align: 'center', label: 'Value', field: 'value' },
    { name: 'date', align: 'center', label: 'Date', field: 'date' },
    { name: 'actions', align: 'center', label: 'Action', field: 'actions' },
  ];

  const { fetchExpenses } = useExpenses();

  const { errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);
  const expenses = ref<Expenses.ListItem[]>([]);
  const showModal = ref<boolean>(false);
  const selectedExpense = ref<number>(0);

  onMounted(() => {
    isLoading.value = true;

    fetchExpenses()
      .then(({ data }) => {
        expenses.value = data.data
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
      .finally(() => {
        isLoading.value = false;
      });
  });

  const onClickDelete = (expenseId: number) => {
    selectedExpense.value = expenseId;
    showModal.value = true;
  };
</script>
