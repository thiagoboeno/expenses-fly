import type { VerificationAccount } from 'src/types/VerificationAccount';
import { useAxios } from './useAxios';
import type { ApiResponseMessage } from 'src/types/ApiResponse';
import { AxiosResponse } from 'axios';

interface UseVerificationAccountReturn {
    fetchVerificationAccount: (params: VerificationAccount.CheckEmail) => Promise<AxiosResponse>;
    fetchResendVerificationLink: () => Promise<AxiosResponse>;
}

export const useVerificationAccount = (): UseVerificationAccountReturn => {
    const { post } = useAxios();

    const fetchVerificationAccount = async (params: VerificationAccount.CheckEmail): Promise<AxiosResponse> => {
        return await post<ApiResponseMessage>('verify-email', params);
    }

    const fetchResendVerificationLink = async (): Promise<AxiosResponse> => {
      return await post<ApiResponseMessage>('verify-email/resend');
  }

    return {
        fetchVerificationAccount,
        fetchResendVerificationLink,
    }
}
