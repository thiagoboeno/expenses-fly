import { useQuasar } from 'quasar';

interface UseNotifyReturn {
  successNotify: (message: string) => void;
  errorNotify: (message: string) => void;
}

export const useNotify = (): UseNotifyReturn => {
  const $q = useQuasar();
  const successNotify = (message: string) => {
    $q.notify({
      type: 'positive',
      position: 'bottom-right',
      message,
    })
  };

  const errorNotify = (message: string) => {
    $q.notify({
      type: 'negative',
      position: 'bottom-right',
      message,
    })
  };

  return {
    successNotify,
    errorNotify,
  };
}
