<template>
  <form @submit.prevent="login">
    <div>
      <label for="email">Email:</label>
      <input v-model="email" type="email" required />
    </div>
    <div>
      <label for="password">Password:</label>
      <input v-model="password" type="password" required />
    </div>
    <button type="submit">Login</button>
  </form>

  <p>
    Don't have an account <button><a href="/api/app/register">Register</a></button>
  </p>
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
<style>
form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 4%;
  align-items: center;
}
</style>
