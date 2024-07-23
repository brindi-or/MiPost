
import { defineStore } from 'pinia'
import axios from 'axios'

export  const useAuthStore = defineStore('auth', {
    state: () => ({

    token: localStorage.getItem('user-token') || '',
    status: '',
    user: {},
    loading: false,
    error: ''
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    authStatus: (state) => state.status
  },

  actions: {
      async login({email, password}) {
        try{
          // Obtenir le CSRF token
        await axios.get("/sanctum/csrf-cookie");

        // Faire la requête de connexion
        const response = await axios.post("/api/login", {
          email,
          password,
        });

        const token = response.data.token;

        //On persiste le token
        localStorage.setItem('user-token', token)

        //On ajoute le token au store
        this.token = token
        this.status = 'Success'
        // this.user

        console.log(token)
      } catch (error) {
        this.status = 'error'
        this.token = ''
        this.user = {}
        localStorage.removeItem('user-token')
        delete axios.defaults.headers.common['Authorization']
        throw error
      }
    },

     async register(name,
              email,
              password,
         password_confirmation)
     {
         try {
          this.loading =true;
            const response = await axios.post('/api/register', {
              name,
              email,
              password,
              password_confirmation
            })

            console.log(response);

         } catch (error) {
             console.log(error);
             this.error = error;
         } finally {
            this.loading  = false;
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


