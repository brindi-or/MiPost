<!-- components/UserProfile.vue -->
<template>
  <div class="user-profile">
    <h2>Mon Profil</h2>
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
      <button type="submit" class="submit-btn">Mettre à jour le profil</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "UserProfile",
  props: {
    user: Object,
  },
  data() {
    return {
      editedUser: { ...this.user },
    };
  },
  methods: {
    submitForm() {
      this.$emit("update", this.editedUser);
    },
  },
};
</script>

<style scoped>
/* ... (styles pour le profil) ... */
</style>
