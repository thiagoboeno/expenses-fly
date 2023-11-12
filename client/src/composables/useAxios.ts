import type { AxiosInstance } from 'axios';
import axios from 'axios';
import { useRouter } from 'vue-router';

interface UseAxiosReturn {
    instance: AxiosInstance;
    get: AxiosInstance['get'];
    post: AxiosInstance['post'];
    put: AxiosInstance['put'];
    delete: AxiosInstance['delete'];
}

export const useAxios = (): UseAxiosReturn => {
    const router = useRouter();

    const apiBaseUrl = process.env.API_URL;

    const bearerToken = () => localStorage.getItem('api-client-token');

    const instance = axios.create({
        baseURL: apiBaseUrl,
        headers: {
            common: {
                Authorization: `Bearer ${bearerToken()}`
            }
        }
    });

    instance.interceptors.response.use(
        response => {
            return response;
        },
        error => {
            if(error?.response?.status == 401) {
              localStorage.removeItem('api-client-token');

              router.push('/login');
            }

            return Promise.reject(error);
        },
    );

    return {
        instance,
        get: instance.get,
        post: instance.post,
        put: instance.put,
        delete: instance.delete,
    };
}
