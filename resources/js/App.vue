<template>
  <router-view></router-view>
  <footer>
    <p>&copy; 2024 Mon Blog. Tous droits réservés.</p>
  </footer>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
body {
  font-family: "Arial", sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}

#app {
  max-width: 1200px;
  margin: 0 auto;
  background-color: #f7efef;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

footer {
  background-color: #34495e;
  color: #fff;
  text-align: center;
  padding: 1rem;
  font-size: 0.9rem;
}

@media (max-width: 768px) {
  #app {
    width: 100%;
    box-shadow: none;
  }

  main {
    padding: 1rem;
  }

  header h1 {
    font-size: 1.5rem;
  }
}
#app {
  padding-left: 10%;
  padding-right: 10%;
  overflow: auto;
}
</style>
