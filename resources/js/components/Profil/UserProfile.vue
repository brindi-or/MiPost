<!-- components/UserProfile.vue -->
<template>
  <div class="user-profile">
    <h2>My Profil</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="name">Nom:</label>
        <input v-model="editedUser.name" id="name" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input v-model="editedUser.email" id="email" type="email" required />
      </div>
      <div class="form-group">
        <label for="bio">Bio:</label>
        <textarea v-model="editedUser.bio" id="bio"></textarea>
      </div>
      <button type="submit" class="submit-btn">Update profil</button>
    </form>
  </div>
</template>

<script>
import { useAuthStore } from "../../store/index";
export default {
  name: "UserProfile",
  props: {
    user: Object,
  },

  data() {
    const authStore = useAuthStore();

    const login = async (email, password) => {
      try {
        await authStore.login({ email, password });
        // Rediriger vers unee page après la connexion
      } catch (error) {
        console.error("Échec de la connexion:", error);
      }
    };
    return {
      editedUser: { ...this.user },
      login,
      authStore,
    };
  },
  methods: {
    submitForm() {
      this.$emit("update", this.editedUser);
    },
  },
  mounted() {
    console.log("pro component mounted");
  },
};
</script>

<style scoped>
/* ... (styles pour le profil) ... */
</style>
