<template>
  <div class="loader" id="loader"></div>
  <div class="container_auth">
    <div id="loginForm">
      <h2>Login</h2>
      <form id="loginForm" @submit.prevent="login">
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="uemailsername" v-model="email" required />
          <div class="error" id="emailError"></div>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="password" required />
          <div class="error" id="passwordError"></div>
        </div>
        <button type="submit" class="auth_button">Log In</button>
      </form>
      <div class="toggle-form">
        Need an account? <a href="#" @click="toggleForm('register')">Register now</a>
      </div>
    </div>

    <div id="registerForm" style="display: none">
      <h2>Register</h2>
      <form @submit.prevent="register">
        <div v-if="authStore.loading">Loading</div>
        <div v-if="authStore.error">error : {{ authStore.error }}</div>
        <div class="input-group">
          <label for="name">Username</label>
          <input type="text" id="name" v-model="name" required />
          <div class="error" id="registerUsernameError"></div>
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="email" required />
          <div class="error" id="registerEmailError"></div>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input id="password" v-model="password" type="password" required />
          <div class="error" id="registerPasswordError"></div>
        </div>
        <div class="input-group">
          <label for="password_confirmation">Confirm Password</label>
          <input
            id="password_confirmation"
            v-model="password_confirmation"
            type="password"
            required
          />
          <div class="error" id="confirmPasswordError"></div>
        </div>
        <button type="submit" class="auth_button" :disable="authStore.loading">
          Register
        </button>
      </form>
      <div class="toggle-form">
        Already have an account?<a href="#" @click="toggleForm('login')"> Login</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "../../store/index";
import { useRouter } from "vue-router";

//Options , Composition
//Options est vieux et le plus populaire
//Composition est recent et le plus robust
const name = ref("");
const password_confirmation = ref("");

const email = ref("");
const router = useRouter();
const authStore = useAuthStore();
const password = ref("");

function toggleForm(formType) {
  if (formType === "register") {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("registerForm").style.display = "block";
  } else {
    document.getElementById("registerForm").style.display = "none";
    document.getElementById("loginForm").style.display = "block";
  }
}

function login() {
  showLoader();
  console.log(email, password);
  try {
    const res = authStore.login({ email: email.value, password: password.value });
    hideLoader();
    console.log(res);
    router.push("/");
  } catch (error) {
    hideLoader();
    console.log("error occured during login", error);
  }
}
function register() {
  authStore.register(
    name.value,
    email.value,
    password.value,
    password_confirmation.value
  );
  // If using Vue 3 Composition API
  router.push("/");
}
function showLoader() {
  document.getElementById("loader").style.display = "flex";
}

function hideLoader() {
  document.getElementById("loader").style.display = "none";
}

function simulateServerRequest(callback) {
  showLoader();
  setTimeout(() => {
    hideLoader();
    callback();
  }, 2000); // Simulates a 2-second delay
}
</script>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Arial", sans-serif;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.container_auth {
  background: rgba(255, 255, 255, 0.9);
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  transition: all 0.3s ease;
  margin-top: 40%;
}

.container_auth:hover {
  transform: translateY(-5px);
}

h2 {
  text-align: center;
  color: #333;
  margin-bottom: 1.5rem;
}

.input-group {
  margin-bottom: 1.5rem;
}

.input-group label {
  display: block;
  margin-bottom: 0.5rem;
  color: #666;
}

.input-group input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  transition: border-color 0.3s ease;
}

.input-group input:focus {
  border-color: #ff9a9e;
  outline: none;
}

.auth_button {
  width: 100%;
  padding: 0.75rem;
  background: linear-gradient(45deg, #ff9a9e, #fad0c4);
  border: none;
  border-radius: 5px;
  color: white;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.auth_button:hover {
  background: linear-gradient(45deg, #fad0c4, #ff9a9e);
}

.error {
  color: #ff4757;
  font-size: 0.85rem;
  margin-top: 0.25rem;
}

.toggle-form {
  text-align: center;
  margin-top: 1rem;
}

.toggle-form a {
  color: #ff9a9e;
  text-decoration: none;
}

.toggle-form a:hover {
  text-decoration: underline;
}

.loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.7);
  z-index: 9999;
  justify-content: center;
  align-items: center;
}

.loader::after {
  content: "";
  width: 50px;
  height: 50px;
  border: 5px solid #ff9a9e;
  border-top: 5px solid #fad0c4;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

@media (max-width: 480px) {
  .container {
    width: 95%;
    padding: 1.5rem;
  }
}
</style>
