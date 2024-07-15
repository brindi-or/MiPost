<template>
  <form @submit.prevent="login">
    <input v-model="email" type="email" required />
    <input v-model="password" type="password" required />
    <button type="submit">Login</button>
  </form>
</template>

<script>
import axios from "axios";

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
        // Obtenir le CSRF token
        await axios.get("/sanctum/csrf-cookie");

        // Faire la requête de connexion
        const response = await axios.post("/api/login", {
          email: this.email,
          password: this.password,
        });

        const token = response.data.token;

        // Stockez le token et redirigez l'utilisateur ici
        // this.$store.commit("setToken", token);
        // this.$router.push("/dashboard");

        console.log("Connexion réussie", token);
      } catch (error) {
        console.error("Échec de la connexion", error.response?.data || error.message);
      }
    },
  },
};
</script>
