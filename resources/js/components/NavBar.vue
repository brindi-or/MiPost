<template>
  <nav class="bg-gradient-to-r from-purple-600 to-indigo-700 p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center navbar-container">
      <div class="flex items-center">
        <img
          class="w-10 h-10 rounded-full image"
          src="https://image.shutterstock.com/image-vector/dotted-spiral-vortex-royaltyfree-images-600w-2227567913.jpg"
          alt="Logo"
        />
        <span class="ml-2 text-white text-xl font-bold">YourApp</span>
      </div>
      <ul
        :class="[
          'flex transition-all duration-300 ease-in-out nav-links',
          { 'nav-active': isNavActive },
        ]"
      >
        <li
          v-for="(link, index) in links"
          :key="index"
          :style="getLinkStyle(index)"
          class="mx-4"
        >
          <a
            :href="link.url"
            @click="link.text === 'Logout' ? handleLogout($event) : null"
            class="text-white hover:text-indigo-200 transition duration-300"
          >
            {{ link.text }}
          </a>
        </li>
      </ul>
      <div class="burger lg:hidden" @click="toggleNav" :class="{ toggle: isNavActive }">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "./../store/index";
import { useRouter } from "vue-router";
import { faLayerGroup } from "@fortawesome/free-solid-svg-icons";

const isNavActive = ref(false);
const authStore = useAuthStore();
const router = useRouter();

const links = ref([
  { text: "Post", url: "/" },
  { text: "Profile", url: "/api/app/profil" },
  { text: "Logout", url: "#" },
]);

const toggleNav = () => {
  isNavActive.value = !isNavActive.value;
};

const getLinkStyle = (index) => {
  if (isNavActive.value) {
    return {
      animation: `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`,
    };
  }
  return {};
};

const handleLogout = async (event) => {
  event.preventDefault();
  console.log("remie");

  authStore.logout();
  router.push("/api/app/login");
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

.image {
  width: 25px;
}

.navbar {
  /* background-color: #333; */
  padding: 1rem;
  position: relative;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

.logo {
  color: white;
  font-size: 1.5rem;
  font-weight: bold;
}

.nav-links {
  display: flex;
  list-style: none;
}

.nav-links li {
  margin-left: 1.5rem;
}

.nav-links a {
  color: white;
  text-decoration: none;
  transition: color 0.3s ease;
}

.nav-links a:hover {
  color: #f0f0f0;
}

.burger {
  display: none;
  cursor: pointer;
}

.burger div {
  width: 25px;
  height: 3px;
  background-color: white;
  margin: 5px;
  transition: all 0.3s ease;
}

@media screen and (max-width: 768px) {
  .nav-links {
    position: absolute;
    right: 0;
    height: calc(100vh - 60px);
    top: 60px;
    background-color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 50%;
    transform: translateX(100%);
    transition: transform 0.5s ease-in;
  }

  .nav-links li {
    opacity: 0;
    margin: 1rem 0;
  }

  .burger {
    display: block;
  }
}

.nav-active {
  transform: translateX(0%);
}

@keyframes navLinkFade {
  from {
    opacity: 0;
    transform: translateX(50px);
  }

  to {
    opacity: 1;
    transform: translateX(0px);
  }
}

.toggle .line1 {
  transform: rotate(-45deg) translate(-5px, 6px);
}

.toggle .line2 {
  opacity: 0;
}

.toggle .line3 {
  transform: rotate(45deg) translate(-5px, -6px);
}
</style>
