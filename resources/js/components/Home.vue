<template>
  <header>
    <NavBar />
  </header>
  <main>
    <Posts></Posts>
  </main>
  <footer>
    <p>&copy; 2024 Mon Blog. Tous droits réservés.</p>
  </footer>
</template>

<script>
import Posts from "./Posts/Posts.vue";
import NavBar from "./NavBar.vue";

export default {
  name: "Home",
  components: { Posts, NavBar },
};
</script>

<style>
header {
  background-color: #3498db;
  color: #fff;
  text-align: center;
  padding: 1rem;
}

header h1 {
  margin: 0;
  font-size: 2rem;
}

main {
  padding: 2rem;
}
</style>
