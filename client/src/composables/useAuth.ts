import type { Auth } from 'src/types/Auth';
import { useAxios } from './useAxios';
import type { ApiResponse } from 'src/types/ApiResponse';
import { AxiosResponse } from 'axios';

interface UseAuthReturn {
    fetchLogin: (params: Auth.Login) => Promise<AxiosResponse>;
    fetchSignUp: (params: Auth.SignUp) => Promise<AxiosResponse>;
    fetchLogout: () => Promise<AxiosResponse>;
    fetchForgotPassword: (params: Auth.ForgotPassword) => Promise<AxiosResponse>;
    fetchResetPassword: (params: Auth.ResetPassword) => Promise<AxiosResponse>;
}

export const useAuth = (): UseAuthReturn => {
    const { post } = useAxios();

    const fetchLogin = async (params: Auth.Login): Promise<AxiosResponse> => {
        return await post<ApiResponse<Auth.Token>>('login', params);
    }

    const fetchSignUp = async (params: Auth.SignUp): Promise<AxiosResponse> => {
        return await post<ApiResponse<Auth.Token>>('sign-up', params);
    }

    const fetchLogout = async (): Promise<AxiosResponse> => {
        return await post<ApiResponse<Auth.Token>>('logout');
    }

    const fetchForgotPassword = async (params: Auth.ForgotPassword): Promise<AxiosResponse> => {
        return await post<ApiResponse<Auth.Token>>('forgot-password', params);
    }

    const fetchResetPassword = async (params: Auth.ResetPassword): Promise<AxiosResponse> => {
        return await post<ApiResponse<Auth.Token>>('reset-password', params);
    }

    return {
        fetchLogin,
        fetchSignUp,
        fetchLogout,
        fetchForgotPassword,
        fetchResetPassword,
    }
}
