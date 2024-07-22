<template>
  <nav class="navbar">
    <div class="navbar-container">
      <div class="logo">
        <img
          class="image"
          src="https://image.shutterstock.com/image-vector/dotted-spiral-vortex-royaltyfree-images-600w-2227567913.jpg"
          alt=""
        />
      </div>
      <ul :class="['nav-links', { 'nav-active': isNavActive }]">
        <li v-for="(link, index) in links" :key="index" :style="getLinkStyle(index)">
          <a :href="link.url">{{ link.text }}</a>
        </li>
      </ul>
      <div class="burger" @click="toggleNav" :class="{ toggle: isNavActive }">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      isNavActive: false,
      links: [
        { text: "Post", url: "/" },
        // { text: "About", url: "#" },
        // { text: "Services", url: "#" },
        { text: "Profile", url: "/api/app/profil" },
      ],
    };
  },
  methods: {
    toggleNav() {
      this.isNavActive = !this.isNavActive;
    },
    getLinkStyle(index) {
      if (this.isNavActive) {
        return {
          animation: `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`,
        };
      }
      return {};
    },
  },
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
  width: 45px;
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
