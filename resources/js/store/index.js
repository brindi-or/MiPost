
import { defineStore } from 'pinia'
import axios from 'axios'
import { useRouter } from 'vue-router';
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
            const user = response.data.user;
        //On persiste le token
        localStorage.setItem('user-token', token)
        //On ajoute le token au store
        this.token = token
        this.user = user
        this.status = 'Success'
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

        const token = response.data.token;
        const user = response.data.user;
        //On persiste le token
        localStorage.setItem('user-token', token)

        //On ajoute le token au store
             this.token = token
             this.user = user
            console.log(response);

         } catch (error) {
             console.log(error);
             this.error = error;
         } finally {
            this.loading  = false;
         }

      },
     async logout() {
         try {
             console.log("logout");
                       // Obtenir le CSRF token
             await axios.get('/sanctum/csrf-cookie').then(response => {
                 // Make your request here, e.g., login or logout
                 // Make a POST request to the logout endpoint
              axios.post('/api/logout', {}, {
                 headers: {
                     'Authorization': `Bearer ${localStorage.getItem('token')}`
                 }
             })

        // Clear the user data from the store
             this.user = {}
             this.token =""
console.log("logout",2);
        //On persiste le token
        localStorage.removeItem('user-token')
        const router = useRouter()  // If using Vue 3 Composition API
});

      } catch (error) {
        console.error('Logout failed', error)
        // Handle any errors (e.g., show an error message to the user)
      }
    }
  }
})


