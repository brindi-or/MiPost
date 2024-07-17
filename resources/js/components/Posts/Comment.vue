<!-- components/CommentsList.vue -->
<template>
  <div class="comments-list">
    <h3>Commentaires</h3>
    <ul>
      <li v-for="comment in comments" :key="comment.id">
        <strong>{{ comment.author }}</strong
        >: {{ comment.body }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "CommentsList",
  props: {
    comments: Array,
  },
};
</script>

<style scoped>
.comments-list {
  margin-top: 1.5rem;
}

h3 {
  color: #3498db;
  border-bottom: 2px solid #3498db;
  padding-bottom: 0.5rem;
  font-size: 1.4rem;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  background-color: #ecf0f1;
  border-radius: 4px;
  padding: 0.8rem;
  margin-bottom: 0.5rem;
}

strong {
  color: #2980b9;
}

@media (max-width: 768px) {
  h3 {
    font-size: 1.2rem;
  }

  li {
    padding: 0.6rem;
  }
}
</style>
