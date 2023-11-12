<template>
  <q-dialog v-model="showModal">
    <q-card>
      <q-card-section class="row items-center">
        <span class="text-h6">
          Delete Expense
        </span>

        <q-space />

        <q-btn icon="close" flat round dense v-close-popup />
      </q-card-section>

      <q-card-section class="row items-center">
        <span class="q-ml-sm">
          Do you really want to delete this expense?
          This action cannot be reversed!
        </span>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn flat label="Cancel" color="primary" :disable="isLoading" v-close-popup />

        <q-btn flat label="Confirm" color="red-5" :loading="isLoading" @click="onClickDelete" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script lang="ts" setup>
  import { ref, computed } from 'vue';
  import { useExpenses } from 'src/composables/useExpenses';
  import { useNotify } from 'src/composables/useNotify';

  interface Props {
    expenseId: number;
    modelValue: boolean;
  }

  const { deleteExpense } = useExpenses();

  const { successNotify, errorNotify } = useNotify();

  const props = defineProps<Props>();

  const emit = defineEmits(['update:modelValue']);

  const isLoading = ref<boolean>(false);

  const showModal = computed<boolean>({
    get() {
      return props.modelValue;
    },
    set(value) {
      emit('update:modelValue', value);
    },
  });

  const expenseId = computed<number>(() => props.expenseId);

  const onClickDelete = () => {
    isLoading.value = false;

    deleteExpense(expenseId.value)
      .then(() => {
        successNotify('Expense successfully deleted!');
      })
      .catch((error) => {
        errorNotify(error?.response?.data?.message);
      })
      .finally(() => {
        isLoading.value = false;
        showModal.value = false;

        location.reload();
      });
  }
</script>
