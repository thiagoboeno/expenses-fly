import { defineStore } from 'pinia';
import { Profile } from 'src/types/Profile'

export const useProfileStore = defineStore('profile', {
  state: () => ({
    profile: {} as Profile.ListItem,
  }),
  getters: {
    profileDetails: (state): Profile.ListItem => state.profile,
  },
  actions: {
    updateProfile(profile: Profile.ListItem) {
      this.profile = profile;
    },
  },
});
