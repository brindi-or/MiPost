<template>
  <form @submit.prevent="register">
    <div v-if="authStore.loading">Loading</div>
    <div v-if="authStore.error">error : {{ authStore.error }}</div>
    <div>
      <label for="name">Name:</label>
      <input id="name" v-model="name" type="text" required />
    </div>
    <div>
      <label for="email">Email:</label>
      <input id="email" v-model="email" type="email" required />
    </div>
    <div>
      <label for="password">Password:</label>
      <input id="password" v-model="password" type="password" required />
    </div>
    <div>
      <label for="password_confirmation">Confirm Password:</label>
      <input
        id="password_confirmation"
        v-model="password_confirmation"
        type="password"
        required
      />
    </div>
    <button type="submit" :disable="authStore.loading">Register</button>

    <!-- <button type="button" @click="setDefaultName">SEt Default</button> -->

    <!-- <h1>Name: {{ name }}</h1> -->
  </form>
  <p>
    Already have an account <button><a href="/api/app/login">Connect now</a></button>
  </p>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "../../store/index";

//Migrer de options API vers Composition API

// Remplacement the data()
const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");

const authStore = useAuthStore();

function setDefaultName() {
  name.value = "Hiro";
  email.value = "hirodiscount@gmail.com";
}
function register() {
  authStore.register(
    name.value,
    email.value,
    password.value,
    password_confirmation.value
  );
  this.$router.push("/");
}
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
