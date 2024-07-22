
import { defineStore } from 'pinia'
import axios from 'axios'

export  const useAuthStore = defineStore('auth', {
    state: () => ({

    token: localStorage.getItem('user-token') || '',
    status: '',
    user: {}
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    authStatus: (state) => state.status
  },

  actions: {
      async login(user) {
          console.log('log in');
      this.status = 'loading'
      try {
        const response = await axios.post('/api/login', user)
        const token = response.data.token
        const userData = response.data.user
        localStorage.setItem('user-token', token)
        axios.defaults.headers.common['Authorization'] = token
        this.token = token
        this.status = 'success'
        this.user = userData
        return response
      } catch (error) {
        this.status = 'error'
        this.token = ''
        this.user = {}
        localStorage.removeItem('user-token')
        delete axios.defaults.headers.common['Authorization']
        throw error
      }
    },

    logout() {
      localStorage.removeItem('user-token')
      delete axios.defaults.headers.common['Authorization']
      this.token = ''
      this.status = ''
      this.user = {}
    }
  }
})


