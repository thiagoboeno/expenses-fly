import { useAxios } from './useAxios';
import type { ApiResponse } from 'src/types/ApiResponse';
import { AxiosResponse } from 'axios';
import { Profile } from 'src/types/Profile';

interface UseProfileReturn {
  fetchProfile: () => Promise<AxiosResponse>;
  updateProfile: (params: Profile.CreationDTO) => Promise<AxiosResponse>;
}

export const useProfile = (): UseProfileReturn => {
    const { get, put } = useAxios();

    const fetchProfile = async (): Promise<AxiosResponse> => {
        return await get<ApiResponse<Profile.ListItem[]>>('profile');
    }
    const updateProfile = async (params: Profile.CreationDTO): Promise<AxiosResponse> => {
        return await put<ApiResponse<Profile.ListItem>>('profile/update', params);
    }

    return {
      fetchProfile,
      updateProfile,
    }
}
