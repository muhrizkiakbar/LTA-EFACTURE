import { defineStore } from 'pinia'

export const useSettingStore = defineStore('setting', {
  state: () => {
    return {
      selected: {
        id: '1',
        label: 'LTA'
      },
    }
  },
  persist: true,
})