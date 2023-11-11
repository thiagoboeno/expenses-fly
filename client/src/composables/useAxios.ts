import type { AxiosInstance } from 'axios';
import axios from 'axios';

interface UseAxiosReturn {
    instance: AxiosInstance;
    get: AxiosInstance['get'];
    post: AxiosInstance['post'];
    put: AxiosInstance['put'];
    delete: AxiosInstance['delete'];
}

const apiBaseUrl = import.meta.env.VITE_API_URL;
const appBaseUrl = import.meta.env.VITE_APP_URL;

const bearerToken = () => localStorage.getItem('dialclient');

const instance = axios.create({
    baseURL: apiBaseUrl,
    headers: {
        common: {
            Authorization: `Bearer ${bearerToken()}`
        }
    }
});

const refreshToken = (freshtoken: string) => {
    if (!freshtoken) {
        return;
    }

    instance.defaults.headers.common.Authorization = freshtoken;
    localStorage.setItem('dialclient', freshtoken.replace('Bearer ', ''));

    axios.post(`${appBaseUrl}/auth/refresh-token`, {
        token: freshtoken
    });
}

export const useAxios = (): UseAxiosReturn => {
    instance.interceptors.response.use(
        response => {
            const freshtoken = response.headers.authorization;

            refreshToken(freshtoken);

            return response;
        },
        error => {
            if(error?.response?.status == 401) {
                axios.post(`${appBaseUrl}/logout`).then(() => {
                    window.location.reload();
                });
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
