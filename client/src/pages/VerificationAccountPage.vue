<script lang="ts" setup>
  import { useNotify } from 'src/composables/useNotify';
  import { useVerificationAccount } from 'src/composables/useVerificationAccount';
  import { onBeforeMount, ref } from 'vue';
  import { useRoute, useRouter } from 'vue-router';

  const { fetchVerificationAccount } = useVerificationAccount();
  const route = useRoute();
  const router = useRouter();

  const { successNotify, errorNotify } = useNotify();

  const isLoading = ref<boolean>(false);

  onBeforeMount(() => {
    checkEmailVerification();
  });

  const checkEmailVerification = () => {
    isLoading.value = true;

    const identifier = route.query.identifier?.toString() || '';
    const hash = route.query.hash?.toString() || '';

    fetchVerificationAccount({ identifier, hash })
      .then((response) => {
        successNotify(response?.data?.message);

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
