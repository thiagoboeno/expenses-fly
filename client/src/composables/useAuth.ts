import type { Invoices } from '@/types/Invoices';
import type { Ref } from 'vue';
import { computed, ref } from 'vue';
import { useAxios } from './useAxios';
import type { ApiResponse } from '@/types/ApiResponse';

type InvoicesApiResponse = ApiResponse<Invoices.ListItem[]>;

interface UseInvoicesReturn {
    isLoading: Ref<boolean>;
    invoices: Ref<Invoices.ListItem[]>;
    pagination?: Ref<InvoicesApiResponse['meta']>;
    fetchInvoices: (clientId: string) => Promise<void>;
}

export const useInvoices = (): UseInvoicesReturn => {
    const { get } = useAxios();
    const isLoading = ref<boolean>(true);
    const invoices = ref<Invoices.ListItem[]>([]);
    const pagination = ref<InvoicesApiResponse['meta']>();

    const page = computed<string>(() => {
        const urlParams = new URLSearchParams(window.location.search);

        return urlParams.get('page') || '1';
    });

    const fetchInvoices = async (clientId: string): Promise<void> => {
        try {
            const { data } = await get<InvoicesApiResponse>(`client/${clientId}/invoices`, {
                params: {
                    page: page.value,
                }
            });

            invoices.value = data.data;
            pagination.value = data.meta;
        } catch (error) {
        } finally {
            isLoading.value = false;
        }
    }

    return {
        isLoading,
        invoices,
        fetchInvoices,
    }
}
