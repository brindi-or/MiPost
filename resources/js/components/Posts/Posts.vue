<template>
  <button @click="showModal = true" class="add-post-btn">Ajouter un article</button>
  <div class="post-list">
    <h3>Liste des posts</h3>
    <button type="submit">Create post</button>
    <article v-for="post in posts" :key="post.id" class="post">
      <h2>{{ post.title }}</h2>
      <p>{{ post.content }}</p>
      <button @click="likePost(post.id)">({{ post.likes_count ?? 0 }})</button>
      <comments-list :comments="post.comments"></comments-list>
    </article>

    <!-- <form @submit.prevent="createPost">
      <input type="text" v-model="newPost.title" placeholder="Titre du post" />
      <textarea
        rows=""
        cols=""
        v-model="newPost.content"
        placeholder="Contenu du post"
      ></textarea>

      <button type="submit">Create post</button>
    </form> -->
    <transition name="modal">
      <add-post-modal
        v-if="showModal"
        @close="showModal = false"
        @add-post="addPost"
        :newPost="newPost"
      ></add-post-modal>
    </transition>
  </div>
</template>

<script>
import CommentsList from "./Comment.vue";

import AddPostModal from "./addPost.vue";
export default {
  components: {
    CommentsList,
    AddPostModal,
  },
  data() {
    return {
      showModal: false,
      posts: [],
      likesCount: 0,
      newPost: {
        title: "",
        content: "",
      },
    };
  },
  methods: {
    getPosts() {
      axios.get("/api/posts").then((response) => {
        console.log("yo", response.data);
        this.posts = response.data;
        this.listenForUpdates();
      });
    },
    /**
     * Send a POST request to '/api/posts' with newPost data, then handle the response by adding the new post to the posts array and resetting the newPost object.
     *
     * @return {void}
     */
    addPost() {
      axios
        .post("/api/posts", this.newPost)
        .then((response) => {
          // this.posts.push(response.data);
          this.getPosts();
          this.newPost = {
            title: "",
            content: "",
          };
          this.showModal = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    listenForUpdates() {
      console.log("testi", this.posts, "listenForUpdates");
      Object.keys(this.posts).forEach((post) => {
        Echo.channel(`post.${post.id}`).listen("NewLike", (e) => {
          // Update likes count for the specific publication
          console.log("test", this.post);
          this.$set(this.post[post.id], "likes_count", e.likesCount);
        });
      });
    },
    async likePost(id) {
      try {
        await axios.post(`api/post/${id}/like`).then((response) => {
          console.log("in", this.posts, this.posts[id]);
          this.posts[id].likes_count = response.data.likes_count;
        });
      } catch (error) {
        console.log(error, "error");
      }
    },
  },
  mounted() {
    this.getPosts();
    this.listenForUpdates();
  },
};
</script>

<style scoped>
.post {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
  margin-bottom: 2rem;
}

.post h2 {
  color: #2c3e50;
  margin-top: 0;
  font-size: 1.8rem;
}

@media (max-width: 768px) {
  .post {
    padding: 1rem;
  }

  .post h2 {
    font-size: 1.5rem;
  }
}
.add-post-btn {
  background-color: #3498db;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1rem;
  margin-bottom: 1rem;
  transition: background-color 0.3s;
}

.add-post-btn:hover {
  background-color: #2980b9;
}

.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s;
}

.modal-enter,
.modal-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .add-post-btn {
    width: 100%;
    padding: 15px;
  }
}
</style>
