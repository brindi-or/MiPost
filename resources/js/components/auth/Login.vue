<template>
  <form @submit.prevent="login">
    <input v-model="email" type="email" required />
    <input v-model="password" type="password" required />
    <button type="submit">Login</button>
  </form>
</template>

<script>
import { useAuthStore } from "../../store/index";
import { mapStores } from "pinia";
//Options , Composition
//Options est vieux et le plus populaire
//Composition est recent et le plus robust

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async login() {
      try {
        this.authStore.login({ email: this.email, password: this.password });
        // Stockez le token et redirigez l'utilisateur ici
        // this.$store.commit("setToken", token);
        this.$router.push("/");
      } catch (error) {
        console.error("Échec de la connexion", error.response?.data || error.message);
      }
    },
  },

  computed: {
    // note we are not passing an array, just one store after the other
    // each store will be accessible as its id + 'Store'
    ...mapStores(useAuthStore),
  },
};
</script>
