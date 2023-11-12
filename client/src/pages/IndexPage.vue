<template>
  <q-page class="row items-center justify-evenly q-gutter-sm" padding>
    <q-card class="col-12 col-sm-4 col-xl-3 q-pa-md shadow-2 my_card" bordered>
      <q-card-section>
        <div class="text-overline text-orange-9">
          Expense
        </div>
      </q-card-section>

      <q-card-actions align="center">
        <q-btn flat color="primary" label="Expenses List" to="/expenses" />
      </q-card-actions>
    </q-card>

    <q-card class="col-12 col-sm-4 col-xl-3 q-pa-md shadow-2 my_card" bordered>
      <q-card-section>
        <div class="text-overline text-orange-9">
          Profile
        </div>
      </q-card-section>

      <q-card-actions align="center">
        <q-btn flat color="primary" label="Profile" to="/profile" />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script setup lang="ts">
</script>
