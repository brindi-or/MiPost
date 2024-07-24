<template>
  <form class="login" @submit.prevent="login">
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

<script setup>
import { ref } from "vue";
import { useAuthStore } from "../../store/index";
import { useRouter } from "vue-router";

//Options , Composition
//Options est vieux et le plus populaire
//Composition est recent et le plus robust

const email = ref("");

const router = useRouter();
const authStore = useAuthStore();
const password = ref("");

function login() {
  console.log(email, password);
  try {
    const res = authStore.login({ email: email.value, password: password.value });
    console.log(res);
    router.push("/");
  } catch (error) {
    console.log("error occured during login", error);
  }
}
</script>
<style>
form.login {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 4%;
  align-items: center;
}
</style>
