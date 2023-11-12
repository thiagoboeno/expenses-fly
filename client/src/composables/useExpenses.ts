import type { Expenses } from 'src/types/Expenses';
import { useAxios } from './useAxios';
import type { ApiResponse } from 'src/types/ApiResponse';
import { AxiosResponse } from 'axios';

interface UseExpensesReturn {
    fetchExpenses: () => Promise<AxiosResponse>;
    getExpense: (expenseId: number) => Promise<AxiosResponse>;
    createExpense: (params: Expenses.CreationDTO) => Promise<AxiosResponse>;
    updateExpense: (expenseId: number, params: Expenses.CreationDTO) => Promise<AxiosResponse>;
    deleteExpense: (expenseId: number) => Promise<AxiosResponse>;
}

export const useExpenses = (): UseExpensesReturn => {
    const { get, post, put, delete: deleteResquest } = useAxios();

    const fetchExpenses = async (): Promise<AxiosResponse> => {
        return await get<ApiResponse<Expenses.ListItem[]>>('expenses');
    }

    const getExpense = async (expenseId: number): Promise<AxiosResponse> => {
        return await get<ApiResponse<Expenses.ListItem[]>>(`expenses/${expenseId}`);
    }

    const createExpense = async (params: Expenses.CreationDTO): Promise<AxiosResponse> => {
        return await post<ApiResponse<Expenses.ListItem>>('expenses', params);
    }

    const updateExpense = async (expenseId: number, params: Expenses.CreationDTO): Promise<AxiosResponse> => {
        return await put<ApiResponse<Expenses.ListItem>>(`expenses/${expenseId}`, params);
    }

    const deleteExpense = async (expenseId: number): Promise<AxiosResponse> => {
      return await deleteResquest<ApiResponse<Expenses.ListItem>>(`expenses/${expenseId}`);
    }

    return {
        fetchExpenses,
        getExpense,
        createExpense,
        updateExpense,
        deleteExpense,
    }
}
